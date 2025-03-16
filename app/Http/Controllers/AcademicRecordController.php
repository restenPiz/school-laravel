<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class AcademicRecordController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('backend.academicRecord.read', compact('students'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
