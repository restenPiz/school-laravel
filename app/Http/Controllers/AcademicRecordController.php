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
            'grade' => 'required|exists:classes,id',
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
