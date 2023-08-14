<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right"> <a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a> </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4" />
                <x-student-tabs :student="$student" />
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4" />


                    @if(!empty($student->guardian))
                        <form method="POST" action="{{ route('guardian.update', $student->guardian->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <!-- Father Information -->
                                <div>
                                    <x-label for="father_name" value="{{ __('Father Name') }}" />
                                    <x-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name', $student->guardian->father_name)" />
                                </div>
                                <div>
                                    <x-label for="father_phone" value="{{ __('Father Phone') }}" />
                                    <x-input id="father_phone" class="block mt-1 w-full" type="text" name="father_phone" :value="old('father_phone', $student->guardian->father_phone)" />
                                </div>
                                <div>
                                    <x-label for="father_occupation" value="{{ __('Father Occupation') }}" />
                                    <x-input id="father_occupation" class="block mt-1 w-full" type="text" name="father_occupation" :value="old('father_occupation', $student->guardian->father_occupation)" />
                                </div>
                                <div>
                                    <x-label for="father_pic" value="{{ __('Father Picture') }}" />
                                    <x-input id="father_pic" class="block mt-1 w-full" type="file" name="father_pic_1" />
                                    @if($student->guardian->father_pic)
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->guardian->father_pic) }}" class="text-blue-500 hover:underline" target="_blank">
                                                Existing Picture
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <!-- Mother Information -->
                                <div>
                                    <x-label for="mother_name" value="{{ __('Mother Name') }}" />
                                    <x-input id="mother_name" class="block mt-1 w-full" type="text" name="mother_name" :value="old('mother_name', $student->guardian->mother_name)" />
                                </div>
                                <div>
                                    <x-label for="mother_phone" value="{{ __('Mother Phone') }}" />
                                    <x-input id="mother_phone" class="block mt-1 w-full" type="text" name="mother_phone" :value="old('mother_phone', $student->guardian->mother_phone)" />
                                </div>
                                <div>
                                    <x-label for="mother_occupation" value="{{ __('Mother Occupation') }}" />
                                    <x-input id="mother_occupation" class="block mt-1 w-full" type="text" name="mother_occupation" :value="old('mother_occupation', $student->guardian->mother_occupation)" />
                                </div>
                                <div>
                                    <x-label for="mother_pic" value="{{ __('Mother Picture') }}" />
                                    <x-input id="mother_pic" class="block mt-1 w-full" type="file" name="mother_pic_1" />
                                    @if($student->guardian->mother_pic)
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->guardian->mother_pic) }}" class="text-blue-500 hover:underline" target="_blank">
                                                Existing Picture
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <!-- Guardian Information -->
                                <div>
                                    <x-label for="guardian_is" value="{{ __('Guardian Relationship') }}" />
                                    <select name="guardian_is" id="guardian_is" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select a relationship</option>
                                        <option value="father" {{ old('guardian_is', $student->guardian->guardian_is) === 'father' ? 'selected' : '' }}>Father</option>
                                        <option value="mother" {{ old('guardian_is', $student->guardian->guardian_is) === 'mother' ? 'selected' : '' }}>Mother</option>
                                        <option value="other" {{ old('guardian_is', $student->guardian->guardian_is) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div>
                                    <x-label for="guardian_name" value="{{ __('Guardian Name') }}" />
                                    <x-input id="guardian_name" class="block mt-1 w-full" type="text" name="guardian_name" :value="old('guardian_name', $student->guardian->guardian_name)" />
                                </div>
                                <div>
                                    <x-label for="guardian_relation" value="{{ __('Guardian Relation') }}" />
                                    <x-input id="guardian_relation" class="block mt-1 w-full" type="text" name="guardian_relation" :value="old('guardian_relation', $student->guardian->guardian_relation)" />
                                </div>
                                <div>
                                    <x-label for="guardian_phone" value="{{ __('Guardian Phone') }}" />
                                    <x-input id="guardian_phone" class="block mt-1 w-full" type="text" name="guardian_phone" :value="old('guardian_phone', $student->guardian->guardian_phone)" />
                                </div>
                                <div>
                                    <x-label for="guardian_occupation" value="{{ __('Guardian Occupation') }}" />
                                    <x-input id="guardian_occupation" class="block mt-1 w-full" type="text" name="guardian_occupation" :value="old('guardian_occupation', $student->guardian->guardian_occupation)" />
                                </div>
                                <div>
                                    <x-label for="guardian_email" value="{{ __('Guardian Email') }}" />
                                    <x-input id="guardian_email" class="block mt-1 w-full" type="email" name="guardian_email" :value="old('guardian_email', $student->guardian->guardian_email)" />
                                </div>
                                <div>
                                    <x-label for="guardian_pic" value="{{ __('Guardian Picture') }}" />
                                    <x-input id="guardian_pic" class="block mt-1 w-full" type="file" name="guardian_pic_1" />
                                    @if($student->guardian->guardian_pic)
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($student->guardian->guardian_pic) }}" class="text-blue-500 hover:underline"  target="_blank">
                                                Existing Picture
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <x-label for="guardian_address" value="{{ __('Guardian Address') }}" />
                                    <textarea name="guardian_address" id="guardian_address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('guardian_address', $student->guardian->guardian_address) }}</textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to update guardian information?')">{{ __('Update Guardian') }}</x-button>
                            </div>
                        </form>

                    @else
                        <form method="POST" action="{{ route('guardian.store', $student->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <!-- Father Information -->
                                <div>
                                    <x-label for="father_name" value="{{ __('Father Name') }}" />
                                    <x-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name')" />
                                </div>
                                <div>
                                    <x-label for="father_phone" value="{{ __('Father Phone') }}" />
                                    <x-input id="father_phone" class="block mt-1 w-full" type="text" name="father_phone" :value="old('father_phone')" />
                                </div>
                                <div>
                                    <x-label for="father_occupation" value="{{ __('Father Occupation') }}" />
                                    <x-input id="father_occupation" class="block mt-1 w-full" type="text" name="father_occupation" :value="old('father_occupation')" />
                                </div>
                                <div>
                                    <x-label for="father_pic" value="{{ __('Father Picture') }}" />
                                    <x-input id="father_pic" class="block mt-1 w-full" type="file" name="father_pic" />
                                </div>
                                <!-- Mother Information -->
                                <div>
                                    <x-label for="mother_name" value="{{ __('Mother Name') }}" />
                                    <x-input id="mother_name" class="block mt-1 w-full" type="text" name="mother_name" :value="old('mother_name')" />
                                </div>
                                <div>
                                    <x-label for="mother_phone" value="{{ __('Mother Phone') }}" />
                                    <x-input id="mother_phone" class="block mt-1 w-full" type="text" name="mother_phone" :value="old('mother_phone')" />
                                </div>
                                <div>
                                    <x-label for="mother_occupation" value="{{ __('Mother Occupation') }}" />
                                    <x-input id="mother_occupation" class="block mt-1 w-full" type="text" name="mother_occupation" :value="old('mother_occupation')" />
                                </div>
                                <div>
                                    <x-label for="mother_pic" value="{{ __('Mother Picture') }}" />
                                    <x-input id="mother_pic" class="block mt-1 w-full" type="file" name="mother_pic" />
                                </div>
                                <!-- Guardian Information -->
                                <div>
                                    <x-label for="guardian_is" value="{{ __('Guardian Relationship') }}" />
                                    <select name="guardian_is" id="guardian_is" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select a relationship</option>
                                        <option value="father">Father</option>
                                        <option value="mother">Mother</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <x-label for="guardian_name" value="{{ __('Guardian Name') }}" />
                                    <x-input id="guardian_name" class="block mt-1 w-full" type="text" name="guardian_name" :value="old('guardian_name')" />
                                </div>
                                <div>
                                    <x-label for="guardian_relation" value="{{ __('Guardian Relation') }}" />
                                    <x-input id="guardian_relation" class="block mt-1 w-full" type="text" name="guardian_relation" :value="old('guardian_relation')" />
                                </div>
                                <div>
                                    <x-label for="guardian_phone" value="{{ __('Guardian Phone') }}" />
                                    <x-input id="guardian_phone" class="block mt-1 w-full" type="text" name="guardian_phone" :value="old('guardian_phone')" />
                                </div>
                                <div>
                                    <x-label for="guardian_occupation" value="{{ __('Guardian Occupation') }}" />
                                    <x-input id="guardian_occupation" class="block mt-1 w-full" type="text" name="guardian_occupation" :value="old('guardian_occupation')" />
                                </div>
                                <div>
                                    <x-label for="guardian_email" value="{{ __('Guardian Email') }}" />
                                    <x-input id="guardian_email" class="block mt-1 w-full" type="email" name="guardian_email" :value="old('guardian_email')" />
                                </div>
                                <div>
                                    <x-label for="guardian_pic" value="{{ __('Guardian Picture') }}" />
                                    <x-input id="guardian_pic" class="block mt-1 w-full" type="file" name="guardian_pic" />
                                </div>
                                <div>
                                    <x-label for="guardian_address" value="{{ __('Guardian Address') }}" />
                                    <textarea name="guardian_address" id="guardian_address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('guardian_address') }}</textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to update guardian information?')">{{ __('Update Guardian') }}</x-button>
                            </div>
                        </form>
                    @endif



                </div>
            </div>
        </div>
    </div> @push('modals') <script>
        // Add a script to format the CNIC input as 00000-0000000-0
        document.getElementById('cnic').addEventListener('input', function(e) {
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
    </script> @endpush
</x-app-layout>