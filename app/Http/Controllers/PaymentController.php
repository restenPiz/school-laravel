<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Payment;
use App\Student;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Pagamento realizado com sucesso!');
    }
    public function filter(Request $request)
    {
        $query = Payment::query();

        if ($request->filled('class_id')) {
            $query->whereHas('fee.class', function ($q) use ($request) {
                $q->where('id', $request->class_id);
            });
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $payments = $query->get();

        return response()->json(['payments' => $payments]);
    }
}
