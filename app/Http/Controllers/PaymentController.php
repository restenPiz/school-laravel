<?php

namespace App\Http\Controllers;

use App\fees;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'fee_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'transaction_reference' => 'nullable|string',
        ]);

        Payment::create($request->all());

        $fee = fees::findOrFail($request->fee_id);
        $fee->update(['status' => 'Pago']);

        return redirect()->back()->with('success', 'Pagamento realizado com sucesso!');
    }
}
