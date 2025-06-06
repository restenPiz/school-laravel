<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AcademicRecordController extends Controller
{
    public function feesFilter(Request $request)
    {
        $year = $request->query('year');

        if (!$year || !is_numeric($year)) {
            return response()->json(['error' => 'Ano inválido'], 400);
        }

        try {
            $fees = fees::whereRaw('YEAR(due_date) = ?', [$year])->get();

            return response()->json(['fees' => $fees]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno', 'message' => $e->getMessage()], 500);
        }
    }
    public function generateFeesForStudent($studentId)
    {
        $student = Student::findOrFail($studentId);
        $grade = Grade::where('id', $student->class_id)->firstOrFail();

        $tuitionFee = $grade->registration_fee;
        $monthlyFee = $grade->monthly_fee;

        $amounts = [
            'monthly' => $monthlyFee,
            'quartely' => $monthlyFee * 3,
            'yearly' => $monthlyFee * 12
        ];
        $intervals = [
            'monthly' => 1,
            'quartely' => 3,
            'yearly' => 12
        ];

        $paymentType = $student->payment_type;
        $amount = $amounts[$paymentType] ?? 0;
        $interval = $intervals[$paymentType] ?? 1;

        fees::create([
            'student_id' => $student->id,
            'class_id' => $student->class_id,
            'payment_type' => $paymentType,
            'amount_due' => $amount + $tuitionFee,
            'amount_paid' => 0,
            'penalty_fee' => 0,
            'due_date' => Carbon::now()->startOfYear()->endOfMonth(),
            'status' => 'Pendente',
        ]);

        for ($i = $interval; $i < 12; $i += $interval) {
            fees::create([
                'student_id' => $student->id,
                'class_id' => $student->class_id,
                'payment_type' => $paymentType,
                'amount_due' => $amount,
                'amount_paid' => 0,
                'penalty_fee' => 0,
                'due_date' => Carbon::now()->startOfYear()->addMonths($i)->endOfMonth(),
                'status' => 'Pendente',
            ]);
        }

        toast('Tuition and tuition fee successfully generated.', 'success');

        return redirect()->back();
    }

    public function index()
    {
        $students = Student::all();
        $classes = Grade::all();
        return view('backend.academicRecord.read', compact('students', 'classes'));
    }

    public function create()
    {
        $students = Student::all();
        $classes = Grade::all();
        return view('backend.academicRecord.create', compact('students', 'classes'));
    }
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:grades,id',
            'payment_type' => 'required|in:monthly,quartely,yearly',
            'due_date' => 'required|date',
            'amount_due' => 'required|numeric|min:1', // Garante que não seja 0
        ]);

        // Criar a propina
        $fee = new fees();
        $fee->student_id = $request->student_id;
        $fee->class_id = $request->class_id;
        $fee->payment_type = $request->payment_type;
        $fee->due_date = $request->due_date;
        $fee->amount_due = $request->amount_due;
        $fee->amount_paid = 0;
        $fee->penalty_fee = 0;
        $fee->status = 'Pendente';

        $fee->save();

        toast('Successfully registered bribe!', 'success');
        return redirect()->back();
    }

    public function generateRecords(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'payment_type' => 'required|in:monthly,quartely,yearly',
            'due_date' => 'required|date',
            'amount_due' => 'required|numeric|min:0',
        ]);

        $fee = new fees();
        $fee->student_id = $request->student_id;
        $fee->class_id = $request->class_id;
        $fee->payment_type = $request->payment_type;
        $fee->due_date = $request->due_date;
        $fee->amount_due = $request->amount_due;
        $fee->save();

        return redirect()->route('fees.create')->with('success', 'Propina registrada com sucesso!');
    }
    private function getCoveredMonths($record)
    {
        $startMonth = Carbon::parse($record->due_date)->month;

        switch ($record->payment_type) {
            case 'monthly':
                return [$startMonth]; // Apenas um mês
            case 'quartely':
                return [$startMonth, $startMonth + 1, $startMonth + 2]; // Três meses consecutivos
            case 'yearly':
                return range(1, 12); // Todo o ano
            default:
                return [];
        }
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
