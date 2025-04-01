<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Note;
use App\Student;
use App\Subject;
use App\User;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
            'first' => 'min:0|max:20',
            'second' => 'min:0|max:20',
            'third' => 'min:0|max:20',
            'work' => 'min:0|max:20',
            'exam' => 'min:0|max:20',
            'subject_id' => 'required',
            'student_id' => 'required',
        ]);

        $note = Note::create(
            [
                'student_id' => $request->student_id,
                'subject_id' => $request->subject_id,
                'first' => $request->first,
                'second' => $request->second,
                'third' => $request->third,
                'work' => $request->work,
                'exam' => $request->exam,
            ]
        );

        return redirect()->back()->with('success', 'Notas lançadas com sucesso!');
    }

    public function delete($id)
    {
        $notes = Note::findOrFail($id);
        $notes->delete();

        toast('Note deleted with successfuly', 'success');

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
        toast('Datas updated with successfuly', 'success');

        return redirect()->back()->with('success', 'Nota actualizada com sucesso!');
    }
    public function student($id)
    {
        $user = User::findOrFail($id);
        $student = Student::findOrFail($user->student->id);

        return view('backend.notes.studentNotes', compact('student'));
    }
}
