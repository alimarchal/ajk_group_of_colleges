<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div>
        <x-label for="fee_category_id" value="{{ __('Fee Category') }}" />
        <select name="filter[feeCategory.id]" id="fee_category_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
            <option value="">Select a fee category</option>
            @foreach(\App\Models\FeeCategory::all() as $fc)
                <option value="{{ $fc->id }}">{{ $fc->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <x-label for="institute_class_id" value="{{ __('Class') }}" />
        <select wire:model="selectedPhase" name="filter[instituteClass.id]" id="institute_class_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">Select a class</option>
            @foreach ($instituteClasses as $ic)
                <option value="{{ $ic->id }}">{{ $ic->name }} - {{ $ic->code }}</option>
            @endforeach
        </select>
    </div>


    <div>
        <x-label for="section_id" value="{{ __('Section') }}" />
        <select id="section_id" name="filter[section.id]" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="" selected>None</option>
            @if(!empty($selectedPhase))
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>