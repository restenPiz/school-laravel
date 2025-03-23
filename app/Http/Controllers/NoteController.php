<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Note;
use App\Student;
use App\Subject;
use DB;
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20', // Ajuste conforme sua regra de notas
            'type' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id',
        ]);

        Note::create([
            'note' => $request->note,
            'type' => $request->type,
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
        ]);

        return redirect()->back()->with('success', 'Nota lançada com sucesso!');
    }
    public function delete($id)
    {
        $notes = Note::findOrFail($id);
        $notes->delete();

        return redirect()->back();
    }
    public function filterByClass(Request $request)
    {
        $query = Student::query();

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('student_id')) {
            $query->where('id', $request->student_id);
        }

        $students = $query->with(['user', 'class', 'parent.user'])->get();

        return response()->json(['students' => $students]);
    }
    public function create($id)
    {
        $student = Student::findOrFail($id);
        return view('backend.notes.create', compact('student'));
    }
}
