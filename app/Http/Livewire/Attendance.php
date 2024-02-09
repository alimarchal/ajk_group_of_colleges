<?php

namespace App\Http\Livewire;

use App\Models\Section;
use DB;
use Livewire\Component;

class Attendance extends Component
{
    public $selectedOption;
    public $selectedSection; // Updated property name
    public $sections;
    public function render()
    {
        $instituteClasses = DB::table('institute_classes')->get();
        return view('livewire.attendance', compact('instituteClasses'));
    }


    public function updatedSelectedOption($value)
    {
        // Update the sections when the class selection changes
        $this->selectedOption = $value;
        $this->loadSections();

        // Reset the selected section when the class changes
        $this->selectedSection = null;
    }

    private function loadSections()
    {
        // Fetch the relevant sections based on the selected class
        $this->sections = Section::where('institute_class_id',$this->selectedOption)->get();
    }
}
