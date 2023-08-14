<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        // Process and store the uploaded images if provided
        if ($request->hasFile('student_pic_1')) {
            $fatherPicPath = $request->file('student_pic_1')->store('student_pics', 'public');
            $request->merge(['student_pic' => $fatherPicPath]);
        }

        // Create a new student record
        $student = Student::create($request->all());

        session()->flash('success', 'Student record created successfully.');
        return to_route('student.guardians', $student->id);

    }

    /**
     * Display the specified resource.
     */
    public function print(Student $student)
    {
        return view('student-information-print.student-admision-print',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'admission_no' => 'required|unique:students,admission_no,' . $student->id,
            'roll_no' => 'required|unique:students,roll_no,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'institute_class_id' => 'nullable|exists:institute_classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'category_id' => 'nullable|exists:categories,id',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'religion' => 'nullable',
            'cast' => 'nullable',
            'mobile_no' => 'required',
            'admission_date' => 'nullable|date',
            'blood_group_id' => 'nullable|exists:blood_groups,id',
            'house' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'measure_date' => 'nullable|date',
            'fees_discount' => 'nullable|integer',
            'medical_history' => 'nullable',
        ]);


        // Process and store the uploaded images if provided
        if ($request->hasFile('student_pic_1')) {
            $fatherPicPath = $request->file('student_pic_1')->store('student_pics', 'public');
            $request->merge(['student_pic' => $fatherPicPath]);
        }


        $student->update($request->all());
        // Create a new student record
        session()->flash('success', 'Student record updated successfully.');
        return to_route('student.show', $student->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
