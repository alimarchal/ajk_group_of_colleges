<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstituteMigrationRequest;
use App\Http\Requests\UpdateInstituteMigrationRequest;
use App\Models\InstituteMigration;
use App\Models\Student;

class InstituteMigrationController extends Controller
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
    public function store(StoreInstituteMigrationRequest $request, Student $student)
    {

        $request->merge(['student_id' => $student->id]);

        // Process and store the uploaded images if provided
        if ($request->hasFile('leaving_certificate_1')) {
            $fatherPicPath = $request->file('leaving_certificate_1')->store('leaving_certificates', 'public');
            $request->merge(['leaving_certificate' => $fatherPicPath]);
        }

        if ($request->hasFile('other_document_1')) {
            $fatherPicPath = $request->file('other_document_1')->store('migrated_other_document', 'public');
            $request->merge(['other_document' => $fatherPicPath]);
        }

        $request->merge(['student_id' => $student->id]);
        $studentGurdianAlertContact = InstituteMigration::create($request->all());
        return to_route('student.instituteMigrationStudent.alerts', $student->id)->with('success', 'Migration record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('institute-migrations.create', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstituteMigration $instituteMigration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstituteMigrationRequest $request, InstituteMigration $instituteMigratedStudent)
    {

        // Process and store the uploaded images if provided
        if ($request->hasFile('leaving_certificate_1')) {
            $leavingCertificatePath = $request->file('leaving_certificate_1')->store('leaving_certificates', 'public');
            $request->merge(['leaving_certificate' => $leavingCertificatePath]);
        }

        if ($request->hasFile('other_document_1')) {
            $otherDocumentPath = $request->file('other_document_1')->store('migrated_other_documents', 'public');
            $request->merge(['other_document' => $otherDocumentPath]);
        }

        // Update the institute migration record
        $instituteMigratedStudent->update($request->all());

        // Redirect with a success message
        return to_route('student.instituteMigrationStudent.alerts', $instituteMigratedStudent->student_id)->with('success', 'Migration record updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstituteMigration $instituteMigration)
    {
        //
    }
}
