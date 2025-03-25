<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use App\User;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    public function teacher($id)
    {
        $user = User::findOrFail($id);

        $teacher = Teacher::with(['user', 'subjects', 'classes', 'students'])
            ->findOrFail($user->teacher->id);

        return view('backend.teachers.subject', compact('teacher'));
    }

    public function index()
    {
        $subjects = Subject::with('teacher')->latest()->paginate(10);
        
        return view('backend.subjects.index', compact('subjects'));

    }
    public function create()
    {
        $teachers = Teacher::latest()->get();

        return view('backend.subjects.create', compact('teachers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:subjects',
            'subject_code'  => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        Subject::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'subject_code'  => $request->subject_code,
            'teacher_id'    => $request->teacher_id,
            'description'   => $request->description
        ]);

        toast('The subject was successfuly added!', 'success');

        return redirect()->route('subject.index');
    }
    public function show(Subject $subject)
    {
        //
    }
    public function edit(Subject $subject)
    {
        $teachers = Teacher::latest()->get();

        return view('backend.subjects.edit', compact('subject','teachers'));
    }
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:subjects,name,'.$subject->id,
            'subject_code'  => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        $subject->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'subject_code'  => $request->subject_code,
            'teacher_id'    => $request->teacher_id,
            'description'   => $request->description
        ]);

        toast('The subject was successfuly updated!', 'success');

        return redirect()->route('subject.index');
    }
    public function destroy(Subject $subject)
    {
        $subject->delete();

        toast('The subject was successfuly deleted!', 'success');
        return back();
    }


    
}
