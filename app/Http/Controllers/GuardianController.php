<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Models\Guardian;
use App\Models\Student;

class GuardianController extends Controller
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
    public function store(StoreGuardianRequest $request, Student $student)
    {

        $request->merge(['student_id' => $student->id]);

        // Process and store the uploaded images if provided
        if ($request->hasFile('father_pic_1')) {
            $fatherPicPath = $request->file('father_pic_1')->store('guardian_pics', 'public');
            $request->merge(['father_pic' => $fatherPicPath]);
        }

        if ($request->hasFile('mother_pic_1')) {
            $motherPicPath = $request->file('mother_pic_1')->store('guardian_pics', 'public');
            $request->merge(['mother_pic' => $motherPicPath]);
        }

        if ($request->hasFile('guardian_pic_1')) {
            $guardianPicPath = $request->file('guardian_pic_1')->store('guardian_pics', 'public');
            $request->merge(['guardian_pic' => $guardianPicPath]);
        }

        $guardian = Guardian::create($request->all());
        session()->flash('Student record created successfully.');
        return to_route('student.guardians',$student->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('guardians.create',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianRequest $request, Student $student)
    {

        // Process and store the uploaded images if provided
        if ($request->hasFile('father_pic_1')) {
            $fatherPicPath = $request->file('father_pic_1')->store('guardian_pics', 'public');
            $request->merge(['father_pic' => $fatherPicPath]);
        }

        if ($request->hasFile('mother_pic_1')) {
            $motherPicPath = $request->file('mother_pic_1')->store('guardian_pics', 'public');
            $request->merge(['mother_pic' => $motherPicPath]);
        }

        if ($request->hasFile('guardian_pic_1')) {
            $guardianPicPath = $request->file('guardian_pic_1')->store('guardian_pics', 'public');
            $request->merge(['guardian_pic' => $guardianPicPath]);
        }

        $student->guardian->update($request->all());
        // Create a new student record
        return to_route('student.guardians', $student->id)->with('success', 'Guardians record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
