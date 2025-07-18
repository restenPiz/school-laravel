<?php

namespace App\Http\Controllers;

use App\fees;
use App\User;
use App\Grade;
use App\Parents;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class StudentController extends Controller
{
    public function generateFee($id)
    {
        $user = User::findOrFail($id);
        $studentId = $user->student->id;

        $fees = DB::table('fees')
            ->where('student_id', $studentId)
            ->orderByRaw("CASE
            WHEN due_date < CURDATE() AND status != 'Pago' THEN 1  -- Overdue fees first
            WHEN due_date >= CURDATE() AND status != 'Pago' THEN 2 -- Upcoming fees
            WHEN status = 'Pago' THEN 3                            -- Paid fees last
            END")
            ->orderBy('due_date')
            ->orderBy('id')
            ->get();

        return view('backend.studentSection.fee', compact('fees'));
    }
    //?Method to return with student datas
    public function getStudentsByClass($classId)
    {
        $students = Student::where('class_id', $classId)->get(['id', 'user_id']);
        $students = $students->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->user->name
            ];
        });

        return response()->json(['students' => $students]);
    }

    public function index(Request $request)
    {
        $query = Student::with(['user', 'class']);

        // Search by student name
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Filter by class
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        // Search by email
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'LIKE', '%' . $request->email . '%');
            });
        }

        $students = $query->latest()->paginate(10);

        $classes = Grade::orderBy('class_name')->get();

        return view('backend.students.index', compact('students', 'classes'));
    }
    public function create()
    {
        $classes = Grade::latest()->get();
        $parents = Parents::with('user')->latest()->get();

        return view(
            'backend.students.create',
            compact('classes', 'parents')
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'parent_id' => 'required|numeric',
            'class_id' => 'required|numeric',
            'roll_number' => [
                'required',
                'numeric',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })
            ],
            'gender' => 'required|string',
            'phone' => 'required|string|max:255',
            'dateofbirth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($user->name) . '-' . $user->id . '.' . $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = 'avatar.png';
        }
        $user->update([
            'profile_picture' => $profile
        ]);

        $user->student()->create([
            'parent_id' => $request->parent_id,
            'class_id' => $request->class_id,
            'roll_number' => $request->roll_number,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'dateofbirth' => $request->dateofbirth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'payment_type' => $request->payment_type,
        ]);

        $user->assignRole('Student');

        (new AcademicRecordController)->generateFeesForStudent($user->student->id);

        toast('Student added with successfuly', 'success');

        return redirect()->route('student.index');
    }

    public function show(Student $student)
    {
        $class = Grade::with('subjects')->where('id', $student->class_id)->first();
        $fees = fees::where('student_id', $student->id)->get();

        return view('backend.students.show', compact('class', 'student', 'fees'));
    }
    public function edit(Student $student)
    {
        $classes = Grade::latest()->get();
        $parents = Parents::with('user')->latest()->get();

        return view('backend.students.edit', compact('classes', 'parents', 'student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->user_id,
            'parent_id' => 'required|numeric',
            'class_id' => 'required|numeric',
            'roll_number' => [
                'required',
                'numeric',
                Rule::unique('students')->ignore($student->id)->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })
            ],
            'gender' => 'required|string',
            'phone' => 'required|string|max:255',
            'dateofbirth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255'
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($student->user->name) . '-' . $student->user->id . '.' . $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            // $profile = $student->user->profile_picture;
            $profile = '';
        }

        $student->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_picture' => $profile
        ]);

        $student->update([
            'parent_id' => $request->parent_id,
            'class_id' => $request->class_id,
            'roll_number' => $request->roll_number,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'dateofbirth' => $request->dateofbirth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);

        toast('success');

        return redirect()->route('student.index');
    }

    public function destroy(Student $student)
    {
        $user = User::findOrFail($student->user_id);
        $user->student()->delete();
        $user->removeRole('Student');

        if ($user->delete()) {
            if ($user->profile_picture != 'avatar.png') {
                $image_path = public_path() . '/images/profile/' . $user->profile_picture;
                if (is_file($image_path) && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        toast('success');

        return back();
    }
}
