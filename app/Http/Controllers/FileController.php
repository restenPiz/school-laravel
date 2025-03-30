<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function classes($id)
    {
        $user = User::findOrFail($id);
        $teacher = Teacher::with(['user', 'subjects', 'classes', 'students'])->withCount('subjects', 'classes')->findOrFail($user->teacher->id);

        return view('backend.files.class', compact('teacher'));
    }
    public function files($id)
    {
        $class = Grade::with(['teacher', 'files'])->findOrFail($id);

        return view('backend.files.file', compact('class'));
    }
    public function index($id)
    {
        $class = Grade::with(['teacher', 'files'])->findOrFail($id);
        return view('backend.files.index', compact('class'));
    }
}
