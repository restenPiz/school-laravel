<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Student;
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
        $student = $request->input('student');

        $query = fees::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        if ($class) {
            $query->where('class_id', $class);
        }

        if ($student) {
            $query->where('student_id', $student);
        }

        $records = $query->get();

        session()->flash('records', $records);

        return back()->with('success', 'Records filtered successfully!');
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
