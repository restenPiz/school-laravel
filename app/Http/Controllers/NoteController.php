<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Note;
use App\Student;
use App\Subject;
use App\User;
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
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'type' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $existingNote = Note::where('student_id', $request->student_id)
            ->where('subject_id', $request->subject_id)
            ->where('type', $request->type)
            ->first();

        if ($existingNote) {
            return redirect()->back()->with('error', 'Este estudante já possui uma nota para esta avaliação.');
        }

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'type' => 'required',
            'subject_id' => 'required',
            'student_id' => 'required',
        ]);

        $notes = Note::findOrFail($id);

        $notes->update([
            'note' => $request->note,
            'type' => $request->type,
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
        ]);

        return redirect()->back()->with('success', 'Nota actualizada com sucesso!');
    }
    public function student($id)
    {
        $user = User::findOrFail($id);
        $student = Student::findOrFail($user->student->id);

        return view('backend.notes.studentNotes', compact('student'));
    }
}
