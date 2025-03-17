<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicRecordController extends Controller
{
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
        $validated = $request->validate([
            'payment_type' => 'required|in:monthly,quartely,yearly',
            'year' => 'required|integer|min:2020|max:' . date('Y'),
            'due_date' => 'required|date',
            'grade' => 'required|exists:grades,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $fee = new fees();
        $fee->payment_type = $validated['payment_type'];
        $fee->year = $validated['year'];
        $fee->due_date = $validated['due_date'];
        $fee->class_id = $validated['grade'];
        $fee->student_id = $validated['student_id'];
        $fee->amount = $this->calculateFeeAmount($validated['payment_type']);
        $fee->status = 'pending';
        $fee->save();

        return redirect()->back()->with('success', 'Fee record added successfully!');
    }
    private function calculateFeeAmount($paymentType)
    {
        switch ($paymentType) {
            case 'monthly':
                return 5000; // Exemplo: 5000 MZN/mês
            case 'quartely':
                return 14000; // Exemplo: 14.000 MZN/trimestre
            case 'yearly':
                return 50000; // Exemplo: 50.000 MZN/ano
            default:
                return 0;
        }
    }
    public function generateRecords(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $class = $request->input('class');
        $studentId = $request->input('student'); // O estudante selecionado

        if (!$studentId) {
            return back()->with('error', 'Selecione um estudante.');
        }

        // Buscar o estudante
        $student = Student::with('user')->find($studentId);
        if (!$student) {
            return back()->with('error', 'Estudante não encontrado.');
        }

        // Buscar os pagamentos do estudante filtrando por ano e classe
        $query = Fees::where('student_id', $studentId)
            ->whereYear('due_date', $year);

        if ($class) {
            $query->where('class_id', $class);
        }

        // Buscar os pagamentos
        $records = $query->get();

        // Verificar se o estudante já pagou no mês selecionado
        $status = 'Pendente';
        foreach ($records as $record) {
            $mesesPagos = $this->getCoveredMonths($record);
            if (in_array($month, $mesesPagos)) {
                $status = 'Pago';
                break;
            }
        }

        // Enviar os dados para a sessão
        session()->flash('records', compact('student', 'status', 'year', 'month'));

        return back();
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
