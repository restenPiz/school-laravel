<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Note;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $classes = Grade::all();
        $subjects = Subject::all();

        return view('backend.notes.index', compact('students', 'classes', 'subjects'));
    }
    public function store(Request $request)
    {
        $notes = new Note();

        $notes->note = $request->input('note');
        $notes->type = $request->input('type');
        $notes->subject_id = $request->input('subject_id');
        $notes->student_id = $request->input('student_id');
        $notes->save();

        return redirect()->back();
    }
    public function delete($id)
    {
        $notes = Note::findOrFail($id);
        $notes->delete();

        return redirect()->back();
    }
    public function filterByClass(Request $request)
    {
        $classes = Grade::all();

        //?Start a collection of students
        $students = collect();
        $selectedStudent = null;

        if ($request->has('class_id')) {
            $students = Student::where('class_id', $request->class_id)->get();
        }

        if ($request->has('student_id')) {
            $selectedStudent = Student::find($request->student_id);
        }

        return view('students.index', compact('classes', 'students', 'selectedStudent'));
    }
}
