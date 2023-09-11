<?php

namespace App\Http\Livewire;

use App\Models\Section;
use DB;
use Livewire\Component;

class StudentClassSection extends Component
{
    public $selectedPhase;
    public $selectedSection; // Updated property name
    public $sections;
    public $student;

    public function mount($student = null)
    {
        $this->student = $student;

        if ($student) {
            // Pre-select the institute_class_id based on the student's data
            $this->selectedPhase = $student->instituteClass->id;
            $this->loadSections();

            $this->selectedSection = $student->section_id; // Make sure $student->section_id is not an array
        }
    }

    public function render()
    {
        $instituteClasses = DB::table('institute_classes')->get();
        return view('livewire.student-class-section', compact('instituteClasses'));
    }

    public function updatedSelectedPhase($value)
    {

        // Update the sections when the class selection changes
        $this->selectedPhase = $value;
        $this->loadSections();

        // Reset the selected section when the class changes
        $this->selectedSection = null;
    }

    private function loadSections()
    {
        // Fetch the relevant sections based on the selected class
        $this->sections = Section::where('institute_class_id',$this->selectedPhase)->get();
    }
}