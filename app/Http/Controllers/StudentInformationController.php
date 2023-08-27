<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    //
    public function index()
    {
        $approved_students = Student::count();
        return view('student-information.index', compact('approved_students'));
    }
}
