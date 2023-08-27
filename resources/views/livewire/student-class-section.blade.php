<div class="grid grid-cols-4 md:grid-cols-4 gap-4 mt-6">
    <div>
        <x-label for="admission_no" value="{{ __('Admission No') }}" />
        <x-input id="admission_no" class="block mt-1 w-full" type="text" value="Auto Generated" disabled />
    </div>
    <div>
        <x-label for="roll_no" value="{{ __('Roll No') }}" />
        <x-input id="roll_no" class="block mt-1 w-full" type="text" name="roll_no" :value="old('roll_no')" required  autofocus />
    </div>

    <div>
        <x-label for="institute_class_id" value="{{ __('Class') }}" />
        <select wire:model="selectedPhase" required name="institute_class_id" id="institute_class_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">Select a class</option>
            @foreach ($instituteClasses as $ic)
                <option value="{{ $ic->id }}">{{ $ic->name }} - {{ $ic->code }}</option>
            @endforeach
        </select>
    </div>


    <div>
        <x-label for="section_id" value="{{ __('Section') }}" />
        <select id="section_id" required name="section_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="" selected>None</option>
            @if(!empty($selectedPhase))
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>