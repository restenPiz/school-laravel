<?php

namespace App\Http\Controllers;

use App\File;
use App\Grade;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240', // Máximo 10MB
            'class_id' => 'required|exists:grades,id',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads/files', 'public');

            $newFile = File::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => $file->getSize(),
                'visibility' => 'restricted',
                'teacher_id' => auth()->user()->teacher->id,
                'class_id' => $request->class_id,
            ]);

            toast('Arquivo enviado com sucesso!', 'success');

            return redirect()->back();
        }

        toast('Arquivo nao enviado!', 'failed');

        return redirect()->back();
    }
    public function delete($id)
    {
        $file = File::findOrFail($id);
        $file->delete();

        toast('File excluded with successfuly', 'success');

        return redirect()->back();
    }
    public function edit($id)
    {
        $file = File::findOrFail($id);

        return view('backend.files.edit', compact('file'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // O arquivo não é obrigatório para atualização
            'class_id' => 'required|exists:grades,id',
        ]);

        $file = File::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($file->file_path && \Storage::exists('public/' . $file->file_path)) {
                \Storage::delete('public/' . $file->file_path);
            }

            $newFile = $request->file('file');
            $filePath = $newFile->store('uploads/files', 'public');

            $file->update([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
                'file_type' => $newFile->getClientOriginalExtension(),
                'file_size' => $newFile->getSize(),
                'teacher_id' => auth()->user()->teacher->id,
                'class_id' => $request->class_id,
            ]);

            toast('Arquivo atualizado com sucesso!', 'success');
        } else {
            $file->update([
                'title' => $request->title,
                'description' => $request->description,
                'class_id' => $request->class_id,
            ]);

            toast('Informações atualizadas com sucesso!', 'success');
        }

        return redirect()->back();
    }
}
