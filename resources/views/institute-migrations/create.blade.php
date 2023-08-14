<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right"><a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">


                <x-status-message class="mb-4"/>
                <x-student-tabs :student="$student"/>
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>

                    @if(!empty($student->instituteMigratedStudent))
                        <form method="POST" action="{{ route('student.instituteMigrationStudent.update', $student->instituteMigratedStudent->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <div>
                                    <x-label for="is_migrated" value="{{ __('Migrated From Another Institute') }}"/>
                                    <select name="is_migrated" id="is_migrated" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select if student is migrated</option>
                                        <option value="1" @if($student->instituteMigratedStudent->is_migrated == 1) selected @endif >Yes</option>
                                        <option value="0" @if($student->instituteMigratedStudent->is_migrated == 0) selected @endif >No</option>
                                    </select>
                                </div>

                                <div>
                                    <x-label for="institute_name" value="{{ __('Institute Name') }}"/>
                                    <x-input id="institute_name" class="block mt-1 w-full" type="text" value="{{ $student->instituteMigratedStudent->institute_name }}" name="institute_name"/>
                                </div>

                                <div>
                                    <x-label for="leaving_certificate" value="{{ __('Leaving Certificate') }}" />
                                    <x-input id="leaving_certificate" class="block mt-1 w-full" type="file" name="leaving_certificate_1" />
                                    @if(!empty($student->instituteMigratedStudent->leaving_certificate))
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->instituteMigratedStudent->leaving_certificate) }}" class="text-blue-500 hover:underline" target="_blank">
                                                Existing Leaving Certificate
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <x-label for="other_document_1" value="{{ __('Other Document') }}" />
                                    <x-input id="other_document_1" class="block mt-1 w-full" type="file" name="other_document_1" />
                                    @if($student->instituteMigratedStudent)
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->instituteMigratedStudent->other_document_1) }}" class="text-blue-500 hover:underline" target="_blank">
                                                Existing Other Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-4">
                                <div>
                                    <x-label for="remarks" value="{{ __('Remarks') }}" />
                                    <textarea name="remarks" id="remarks" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $student->instituteMigratedStudent->remarks }}</textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to update guardian alert contacts?')">{{ __('Update Guardian Alert Contacts') }}</x-button>
                            </div>
                        </form>

                    @else

                        <form method="POST" action="{{ route('student.instituteMigrationStudent.store', $student->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <div>
                                    <x-label for="is_migrated" value="{{ __('Migrated From Another Institute') }}"/>
                                    <select name="is_migrated" id="is_migrated" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select if student is migrated</option>
                                        <option value="1" >Yes</option>
                                        <option value="0" >No</option>
                                    </select>
                                </div>

                                <div>
                                    <x-label for="institute_name" value="{{ __('Institute Name') }}"/>
                                    <x-input id="institute_name" class="block mt-1 w-full" type="text" name="institute_name" :value="old('institute_name')"/>
                                </div>

                                <div>
                                    <x-label for="leaving_certificate" value="{{ __('Leaving Certificate') }}" />
                                    <x-input id="leaving_certificate" class="block mt-1 w-full" type="file" name="leaving_certificate_1" />
                                    @if($student->instituteMigration)
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->instituteMigration->leaving_certificate) }}" class="text-blue-500 hover:underline" target="_blank">
                                                Existing Leaving Certificate
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <x-label for="other_document_1" value="{{ __('Other Document') }}" />
                                    <x-input id="other_document_1" class="block mt-1 w-full" type="file" name="other_document_1" />
                                    @if($student->instituteMigration)
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->instituteMigration->other_document_1) }}" class="text-blue-500 hover:underline" target="_blank">
                                                Existing Other Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-4">
                                <div>
                                    <x-label for="remarks" value="{{ __('Remarks') }}" /> <textarea name="remarks" id="remarks" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to update guardian alert contacts?')">{{ __('Update Guardian Alert Contacts') }}</x-button>
                            </div>
                        </form>

                    @endif
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