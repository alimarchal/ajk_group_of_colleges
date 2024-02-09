<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div>
        <x-label for="institute_class_id" value="{{ __('Class') }}"/>
        <select wire:model="selectedOption" name="filter[instituteClass.id]" id="institute_class_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">Select a class</option>
            @foreach ($instituteClasses as $ic)
                <option value="{{ $ic->id }}">{{ $ic->name }} - {{ $ic->code }}</option>
            @endforeach
        </select>
    </div>


    <div>
        <x-label for="section_id" value="{{ __('Section') }}"/>
        <select id="section_id" name="filter[section.id]" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="" selected>None</option>
            @if(!empty($selectedOption))
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
