<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Parents;
use App\Payment;
use App\Student;
use App\Teacher;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('Admin')) {

            $parents = Parents::latest()->get();
            $teachers = Teacher::latest()->get();
            $students = Student::latest()->get();
            $subjects = Subject::latest()->get();
            $classes = Grade::latest()->get();
            $payments = Payment::all();

            toast('Welcome Admin', 'success');

            return view('home', compact('payments', 'parents', 'teachers', 'students', 'subjects', 'classes'));

        } elseif ($user->hasRole('Teacher')) {

            $teacher = Teacher::with(['user','subjects','classes','students'])->withCount('subjects','classes')->findOrFail($user->teacher->id);
            toast('Welcome Teacher', 'success');
            return view('home', compact('teacher'));

        } elseif ($user->hasRole('Parent')) {

            $parents = Parents::with(['children'])->withCount('children')->findOrFail($user->parent->id);

            toast('Welcome Parent', 'success');

            return view('home', compact('parents'));

        } elseif ($user->hasRole('Student')) {
            
            $student = Student::with(['user','parent','class','attendances'])->findOrFail($user->student->id);

            toast('Welcome Student', 'success');

            return view('home', compact('student'));

        } else {
            return 'NO ROLE ASSIGNED YET!';
        }
        
    }

    public function profile() 
    {
        return view('profile.index');
    }

    public function profileEdit() 
    {
        return view('profile.edit');
    }

    public function profileUpdate(Request $request) 
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id()
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug(auth()->user()->name).'-'.auth()->id().'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = 'avatar.png';
        }

        $user = auth()->user();

        $user->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'profile_picture'   => $profile
        ]);

        toast('Profile datas updated with successfuly!', 'success');

        return redirect()->route('profile');
    }
    public function changePasswordForm()
    {  
        return view('profile.changepassword');
    }

    public function changePassword(Request $request)
    {     
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
            toast('our current password does not matches with the password you provided! Please try again.', 'error');
            return back()->with([
                'msg_currentpassword' => 'Your current password does not matches with the password you provided! Please try again.'
            ]);
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){
            toast('New Password cannot be same as your current password! Please choose a different password.', 'error');
            return back()->with([
                'msg_currentpassword' => 'New Password cannot be same as your current password! Please choose a different password.'
            ]);
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword'     => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Auth::logout();
        return redirect()->route('login');
    }
}
