<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstituteClassRequest;
use App\Http\Requests\UpdateInstituteClassRequest;
use App\Models\InstituteClass;

class InstituteClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituteClass = InstituteClass::all();
        return view('institute-class.index', compact('instituteClass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institute-class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstituteClassRequest $request)
    {

        $instituteClass = InstituteClass::create($request->all());

        session()->flash('success', 'Class generated successfully.');
        return to_route('instituteClass.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(InstituteClass $instituteClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstituteClass $instituteClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstituteClassRequest $request, InstituteClass $instituteClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstituteClass $instituteClass)
    {
        //
    }
}
