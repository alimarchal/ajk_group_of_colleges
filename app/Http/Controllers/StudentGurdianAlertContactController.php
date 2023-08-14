<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentGurdianAlertContactRequest;
use App\Http\Requests\UpdateStudentGurdianAlertContactRequest;
use App\Models\Student;
use App\Models\StudentGurdianAlertContact;

class StudentGurdianAlertContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentGurdianAlertContactRequest $request, Student $student)
    {
        $request->merge(['student_id' => $student->id]);
        $studentGurdianAlertContact = StudentGurdianAlertContact::create($request->all());
        return to_route('student.guardians.alerts',$student->id)->with('success', 'Student gurdian alert record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('student-gurdian-alert-contact.create',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentGurdianAlertContact $studentGurdianAlertContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentGurdianAlertContactRequest $request, Student $student)
    {
        $student->emergencyContact->update($request->all());
        // Create a new student record
        return to_route('student.guardians.alerts', $student->id)->with('success', 'Guardians record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentGurdianAlertContact $studentGurdianAlertContact)
    {
        //
    }
}
