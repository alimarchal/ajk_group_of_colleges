<?php

namespace App\Http\Livewire;

use DB;
use Livewire\Component;

class StudentClassSection extends Component
{
    public $selectedPhase;
    public $sections;

    public function render()
    {
        $instituteClasses = DB::table('institute_classes')->get();
        return view('livewire.student-class-section', compact('instituteClasses'));
    }

    public function updatedSelectedPhase($value)
    {
        $sections = DB::table('sections')->where('institute_class_id', $value)->get();
        if ($sections->isNotEmpty()) {
            $this->sections = $sections;
        } else {
            $this->selectedPhase = '';
        }
    }
}
