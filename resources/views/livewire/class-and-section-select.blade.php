<!-- resources/views/livewire/class-and-section-select.blade.php -->
<div>
    <div>
        <x-label for="admission_no" value="{{ __('Admission No') }}" />
        <x-input id="admission_no" class="block mt-1 w-full" type="text" name="admission_no" :value="old('admission_no')" required autofocus />
    </div>
    <div>
        <x-label for="roll_no" value="{{ __('Roll No') }}" />
        <x-input id="roll_no" class="block mt-1 w-full" type="text" name="roll_no" :value="old('roll_no')" required autofocus />
    </div>

    <div>
        <x-label for="institute_class_id" value="{{ __('Institute Class') }}" />
        <select wire:model="selectedClassId" id="institute_class_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
            <option value="">Select a class</option>
            @foreach ($instituteClasses as $ic)
                <option value="{{ $ic->id }}">{{ $ic->name }} - {{ $ic->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <x-label for="section_id" value="{{ __('Section') }}" />
        <select wire:model="selectedSectionId" id="section_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
            <option value="">Select a section</option>
            @foreach ($sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
        </select>
    </div>
</div>
