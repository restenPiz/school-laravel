<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicRecordController extends Controller
{
    //?Start with the generate method to all the fees of students
    public function generateFeesForStudent(Student $student)
    {
        $amount = $this->getFeeAmount($student->payment_type);

        // Determinar a quantidade de parcelas com base no tipo de pagamento
        $interval = match ($student->payment_type) {
            'monthly' => 1,
            'quartely' => 3,
            'yearly' => 12,
        };

        // Criar registros de mensalidade para o ano atual
        for ($i = 1; $i <= 12; $i += $interval) {
            fees::create([
                'student_id' => $student->id,
                'class_id' => $student->class_id,
                'payment_type' => $student->payment_type,
                'amount_due' => $amount,
                'amount_paid' => 0,
                'penalty_fee' => 0,
                'due_date' => now()->startOfYear()->addMonths($i)->endOfMonth(),
                'status' => 'Pendente',
            ]);
        }
    }

    private function getFeeAmount($paymentType)
    {
        return match ($paymentType) {
            'monthly' => 5000,
            'quartely' => 14000,
            'yearly' => 50000,
            default => 0,
        };
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

        return redirect()->back()->with('success', 'Propina registrada com sucesso!');
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

        // $year = $request->input('year');
        // $class = $request->input('class');
        // $student = $request->input('student');

        // $propinas = fees::where('year', $year)
        //     ->when($class, fn($query) => $query->where('class_id', $class))
        //     ->when($student, fn($query) => $query->where('student_id', $student))
        //     ->get();

        // $paidMonths = [];

        // foreach ($propinas as $propina) {
        //     $dueDate = \Carbon\Carbon::parse($propina->due_date);

        //     if ($propina->payment_type === 'monthly') {
        //         $paidMonths[] = $dueDate->month;
        //     } elseif ($propina->payment_type === 'quartely') {
        //         $paidMonths = array_merge($paidMonths, [$dueDate->month, $dueDate->month + 3, $dueDate->month + 6, $dueDate->month + 9]);
        //     } elseif ($propina->payment_type === 'yearly') {
        //         $paidMonths = range(1, 12);
        //     }
        // }

        // $allMonths = range(1, 12);

        // $pendingMonths = array_diff($allMonths, $paidMonths);

        // session()->flash('records', $propinas);
        // session()->flash('paidMonths', $paidMonths);
        // session()->flash('pendingMonths', $pendingMonths);

        // return back()->with('success', 'Records generated successfully!');
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
