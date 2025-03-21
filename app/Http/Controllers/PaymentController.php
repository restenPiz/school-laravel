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
        $payments = Payment::where('amount', $request->input('amount'))
            ->where('payment_method', $request->input('payment_method'))
            ->get();

        return redirect()->back()->with('payments');
    }
}
