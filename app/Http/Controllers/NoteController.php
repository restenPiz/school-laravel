<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Validation\Rule;
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

        //*Condicoes para calculo da situacao do estudante
        $note1 = DB::table('notes')->where('first')->get();
        $note2 = DB::table('notes')->where('second')->get();
        $note3 = DB::table('notes')->where('third')->get();
        $note1 = DB::table('notes')->where('work')->get();

        return view('backend.notes.index', compact('students', 'classes', 'subjects'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first' => 'nullable|numeric|min:0|max:20|unique:notes,first,NULL,id,student_id,' . $request->student_id,
            'second' => 'nullable|numeric|min:0|max:20|unique:notes,second,NULL,id,student_id,' . $request->student_id,
            'third' => 'nullable|numeric|min:0|max:20|unique:notes,third,NULL,id,student_id,' . $request->student_id,
            'work' => 'nullable|numeric|min:0|max:20|unique:notes,work,NULL,id,student_id,' . $request->student_id,
            'exam' => 'nullable|numeric|min:0|max:20|unique:notes,exam,NULL,id,student_id,' . $request->student_id,
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id',
        ]);

        if (!$validated) {
            toast($validated, 'error');
            return back();
        }

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

        $notes = DB::table('notes')->where('student_id', $note->student_id)->get();

        $note1 = $notes->where('first', '!=', null)->first();
        $note2 = $notes->where('second', '!=', null)->first();
        $note3 = $notes->where('third', '!=', null)->first();
        $note4 = $notes->where('work', '!=', null)->first();

        $media = null;
        $status = 'excluido';

        if ($note1 && $note2 && $note3 && $note4) {
            $media = ($note1->first + $note2->second + $note3->third + $note4->work) / 4;

            if ($media >= 10) {
                $status = 'aprovado';
            } else {
                $status = 'excluido';
            }
        }

        $note->update(['status' => $status]);

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

        // Verifica se o aluno já tem notas registradas
        $notes = DB::table('notes')->where('student_id', $student->id)->get();

        // Verifica se todas as notas foram lançadas
        $first = $notes->where('first', '!=', null)->first();
        $second = $notes->where('second', '!=', null)->first();
        $third = $notes->where('third', '!=', null)->first();
        $work = $notes->where('work', '!=', null)->first();

        // Inicializando as variáveis das notas
        $note1 = $first ? $first->first : null;
        $note2 = $second ? $second->second : null;
        $note3 = $third ? $third->third : null;
        $note4 = $work ? $work->work : null;

        // Inicializando a média e status
        $media = null;
        $status = 'excluido'; // Caso ainda não tenha todas as notas

        // Verifica se todas as notas foram lançadas
        if ($note1 !== null && $note2 !== null && $note3 !== null && $note4 !== null) {
            // Calcula a média se todas as notas foram lançadas
            $media = ($note1 + $note2 + $note3 + $note4) / 4;

            // Verifica a situação do aluno baseado na média
            if ($media >= 10) {
                $status = 'aprovado';
            } else {
                $status = 'excluido';  // Aqui você pode adicionar alguma lógica para determinar se o aluno vai para exame
            }
        }

        // Retorna a view com as informações do aluno, média e status
        return view('backend.notes.create', compact('student', 'media', 'status'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first' => 'nullable|numeric|min:0|max:20|unique:notes,first,NULL,id,student_id,' . $request->student_id . ',id,' . $id,
            'second' => 'nullable|numeric|min:0|max:20|unique:notes,second,NULL,id,student_id,' . $request->student_id . ',id,' . $id,
            'third' => 'nullable|numeric|min:0|max:20|unique:notes,third,NULL,id,student_id,' . $request->student_id . ',id,' . $id,
            'work' => 'nullable|numeric|min:0|max:20|unique:notes,work,NULL,id,student_id,' . $request->student_id . ',id,' . $id,
            'exam' => 'nullable|numeric|min:0|max:20|unique:notes,exam,NULL,id,student_id,' . $request->student_id . ',id,' . $id,
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $note = Note::findOrFail($id);

        $note->update([
            'first' => $request->first,
            'second' => $request->second,
            'third' => $request->third,
            'work' => $request->work,
            'exam' => $request->exam,
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
        ]);

        $notes = DB::table('notes')->where('student_id', $note->student_id)->get();

        $note1 = $notes->where('first', '!=', null)->first();
        $note2 = $notes->where('second', '!=', null)->first();
        $note3 = $notes->where('third', '!=', null)->first();
        $note4 = $notes->where('work', '!=', null)->first();

        $media = null;
        $status = 'excluido';

        if ($note1 && $note2 && $note3 && $note4) {
            $media = ($note1->first + $note2->second + $note3->third + $note4->work) / 4;

            if ($media >= 10) {
                $status = 'aprovado';
            } else {
                $status = 'excluido';
            }
        }

        $note->update(['status' => $status]);

        return redirect()->back()->with('success', 'Notas atualizadas com sucesso!');

    }
    public function student($id)
    {
        $user = User::findOrFail($id);
        $student = Student::findOrFail($user->student->id);

        return view('backend.notes.studentNotes', compact('student'));
    }
}
