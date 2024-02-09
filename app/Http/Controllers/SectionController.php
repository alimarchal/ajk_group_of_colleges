<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = Section::all();
        return view('sections.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->all());
        $sections = $section->sections;
        session()->flash('success', 'Class generated successfully.');
        return to_route('instituteClass.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->all());
        session()->flash('success', 'Section updated successfully.');
        return to_route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
