<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Payment;
use App\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index()
    {
        $classes = Grade::all();
        $students = Student::all();
        $payments = Payment::all();
        return view('backend.academicRecord.payment', compact('classes', 'students', 'payments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_id' => 'required|exists:fees,id',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $fee = fees::find($request->fee_id);
                    if (!$fee) {
                        return $fail('Mensalidade não encontrada.');
                    }
                    if ($value != $fee->amount_due) {
                        return $fail('O valor pago deve ser exatamente ' . number_format($fee->amount_due, 2, ',', '.') . ' MT.');
                    }
                }
            ],
            'payment_method' => 'required',
            'transaction_reference' => 'nullable|string',
        ]);

        Payment::create($request->all());

        $fee = Fees::findOrFail($request->fee_id);
        $fee->update([
            'amount_paid' => $fee->amount_due,
            'amount_due' => 0,
            'status' => 'Pago'
        ]);

        toast('Payment successful!', 'success');

        return redirect()->back()->with('success', 'Pagamento realizado com sucesso!');
    }
    public function filter(Request $request)
    {
        $filters = $request->only(['class_id', 'student_id', 'payment_method', 'year']);

        $payments = Payment::query()
            ->when(!empty($filters['class_id']), function ($query) use ($filters) {
                $query->whereHas('fee.class', function ($q) use ($filters) {
                    $q->where('id', $filters['class_id']);
                });
            })
            ->when(!empty($filters['student_id']), function ($query) use ($filters) {
                $query->where('student_id', $filters['student_id']);
            })
            ->when(!empty($filters['payment_method']), function ($query) use ($filters) {
                $query->where('payment_method', $filters['payment_method']);
            })
            ->when(!empty($filters['year']), function ($query) use ($filters) {
                $query->whereHas('fee', function ($q) use ($filters) {
                    $q->whereYear('due_date', $filters['year']);
                });
            })
            ->get();

        return view('backend.academicRecord.payment', [
            'classes' => Grade::all(),
            'students' => !empty($filters['class_id']) ? Student::where('class_id', $filters['class_id'])->get() : [],
            'payments' => $payments,
            'filters' => $filters,
        ]);
    }
}
