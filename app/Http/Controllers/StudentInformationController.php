<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    //
    public function index()
    {
        return view('student-information.index');
    }
}
