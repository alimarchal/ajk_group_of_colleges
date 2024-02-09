<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Edit Section') }} </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('section.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4"/>
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>

                    <form method="POST" action="{{ route('section.update', $section->id) }}">
                        @csrf
                        @method('PUT') <!-- Use 'PUT' or 'PATCH' method for editing -->

                        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 mt-4">

                            <div>
                                <x-label for="institute_class_id" value="{{ __('Class') }}"/>
                                <select required name="institute_class_id" id="institute_class_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a class</option>
                                    @foreach(\App\Models\InstituteClass::where('active',1)->get() as $ic)
                                        <option value="{{ $ic->id }}" {{ $section->institute_class_id == $ic->id ? 'selected' : '' }}>{{ $ic->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-label for="name" value="{{ __('Section Name') }}" />
                                <select required name="name" id="active" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a section</option>
                                    <option value="A" {{ $section->name == "A" ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $section->name == "B" ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ $section->name == "C" ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ $section->name == "D" ? 'selected' : '' }}>D</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="active" value="{{ __('Status') }}"/>
                                <select required name="active" id="active" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a status</option>
                                    <option value="1" {{ $section->active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $section->active == 0 ? 'selected' : '' }}>In-Active</option>
                                </select>
                            </div>

                        </div>
                        <div class="flex items-center justify-end mt-2">
                            <x-button class="ml-4">{{ __('Update') }}</x-button> <!-- Change the button text to 'Update' -->
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div> @push('modals')
        <script>
            // Add a script to format the CNIC input as 00000-0000000-0
            document.getElementById('cnic').addEventListener('input', function (e) {
                const cnicInput = e.target;
                let cnic = cnicInput.value.replace(/[^0-9]/g, '');
                if (cnic.length > 13) {
                    cnic = cnic.slice(0, 13);
                }
                const parts = cnic.match(/(\d{5})(\d{7})(\d{1})?/);
                if (parts) {
                    let formattedCnic = parts[1] + '-' + parts[2];
                    if (parts[3]) {
                        formattedCnic += '-' + parts[3];
                    }
                    cnicInput.value = formattedCnic;
                } else {
                    cnicInput.value = cnic;
                }
            });
            // // Disable the submit button after it's clicked
            // document.getElementById('submit-btn').addEventListener('click', function (e) {
            //     // Disable the button to prevent multiple submissions
            //     this.disabled = true;
            // });
        </script>
    @endpush
</x-app-layout>