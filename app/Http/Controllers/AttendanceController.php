<?php

namespace App\Http\Controllers;

use App\fees;
use App\Grade;
use App\Student;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use App\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function studentAttendance($id)
    {
        $user = User::findOrFail($id);
        $studentId = $user->student->id;
        $student = Student::findOrFail($studentId);

        return view('backend.studentSection.attendance', compact('student'));
    }
    public function index()
    {
        $months = Attendance::select('attendence_date')
                            ->orderBy('attendence_date')
                            ->get()
                            ->groupBy(function ($val) {
                                return Carbon::parse($val->attendence_date)->format('m');
                            });

        if( request()->has(['type', 'month']) ) {
            $type = request()->input('type');
            $month = request()->input('month');

            if($type == 'class') {
                $attendances = Attendance::whereMonth('attendence_date', $month)
                                     ->select('attendence_date','student_id','attendence_status','class_id')
                                     ->orderBy('class_id','asc')
                                     ->get()
                                     ->groupBy(['class_id','attendence_date']);

                return view('backend.attendance.index', compact('attendances','months'));

            }
            
        }
        $attendances = [];
        
        return view('backend.attendance.index', compact('attendances','months'));
    }
    public function create()
    {
        
    }

    public function createByTeacher($classid)
    {
        $class = Grade::with(['students','subjects','teacher'])->findOrFail($classid);

        return view('backend.attendance.create', compact('class'));
    }
    public function store(Request $request)
    {
        $classid    = $request->class_id;
        $attenddate = date('Y-m-d');

        $teacher = Teacher::findOrFail(auth()->user()->teacher->id);
        $class   = Grade::find($classid);

        if($teacher->id !== $class->teacher_id) {
            return redirect()->route('teacher.attendance.create',$classid)
                             ->with('status', 'You are not assign for this class attendence!');
        }

        $dataexist = Attendance::whereDate('attendence_date',$attenddate)
                                ->where('class_id',$classid)
                                ->get();

        if (count($dataexist) !== 0 ) {
            return redirect()->route('teacher.attendance.create',$classid)
                             ->with('status', 'Attendance already taken!');
        }

        $request->validate([
            'class_id'      => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'attendences'   => 'required'
        ]);

        foreach ($request->attendences as $studentid => $attendence) {

            if( $attendence == 'present' ) {
                $attendence_status = true;
            } else if( $attendence == 'absent' ){
                $attendence_status = false;
            }

            Attendance::create([
                'class_id'          => $request->class_id,
                'teacher_id'        => $request->teacher_id,
                'student_id'        => $studentid,
                'attendence_date'   => $attenddate,
                'attendence_status' => $attendence_status
            ]);
        }

        return back();
    }

    public function show($attendance, Attendance $att)
    {
        $attendances = Attendance::where('student_id', $attendance)->get();
        $fees = Fees::where('student_id', $attendance)->get();

        return view('backend.attendance.show', compact('attendances', 'fees'));
    }
    public function edit(Attendance $attendance)
    {
        //
    }
    public function update(Request $request, Attendance $attendance)
    {
        //
    }
    public function destroy(Attendance $attendance)
    {
        //
    }
}
