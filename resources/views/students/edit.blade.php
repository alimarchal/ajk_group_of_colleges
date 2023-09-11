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


                    <form method="POST" action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <livewire:student-class-section :student="$student"  />




                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
{{--                            <div>--}}
{{--                                <x-label for="admission_no" value="{{ __('Admission No') }}"/>--}}
{{--                                <x-input id="admission_no" class="block mt-1 w-full" type="text" name="admission_no" readonly :value="old('admission_no', $student->admission_no)"/>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <x-label for="roll_no" value="{{ __('Roll No') }}"/>--}}
{{--                                <x-input id="roll_no" class="block mt-1 w-full" type="text" name="roll_no" :value="old('roll_no', $student->roll_no)" required/>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <x-label for="institute_class_id" value="{{ __('Institute Class') }}"/>--}}
{{--                                <select name="institute_class_id" id="institute_class_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">--}}
{{--                                    <option value="">Select a class</option>--}}
{{--                                    @foreach (\App\Models\InstituteClass::all() as $ic)--}}
{{--                                        <option value="{{ $ic->id }}" {{ old('institute_class_id', $student->institute_class_id) == $ic->id ? 'selected' : '' }}>--}}
{{--                                            {{ $ic->name }} - {{ $ic->code }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <x-label for="section_id" value="{{ __('Section') }}"/>--}}
{{--                                <select name="section_id" id="section_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">--}}
{{--                                    <option value="">Select a section</option>--}}
{{--                                    @foreach (\App\Models\Section::all() as $section)--}}
{{--                                        <option value="{{ $section->id }}" {{ old('section_id', $student->section_id) == $section->id ? 'selected' : '' }}>--}}
{{--                                            {{ $section->name }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}


                            <div>
                                <x-label for="institute_session_id" value="{{ __('Session Year') }}" /> <!-- Add your select input for category_id here -->
                                <select name="institute_session_id" id="institute_session_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a session</option>
                                    @foreach (\App\Models\InstituteSession::where('status',1)->get() as $session)
                                        <option value="{{ $session->id }}" @if(!empty($student->latestStudentSession)) {{ old('session_year', $student->latestStudentSession->institute_session_id) == $session->id ? 'selected' : '' }}  @endif>{{ $session->session_year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-label for="category_id" value="{{ __('Category') }}"/>
                                <select name="category_id" id="category_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a category</option>
                                    @foreach (\App\Models\Category::all() as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $student->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="firstname" value="{{ __('First Name') }}"/>
                                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname', $student->firstname)" required/>
                            </div>
                            <div>
                                <x-label for="lastname" value="{{ __('Last Name') }}"/>
                                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname', $student->lastname)" required/>
                            </div>
                            <div>
                                <x-label for="gender" value="{{ __('Gender') }}"/>
                                <select name="gender" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a gender</option>
                                    <option value="Male" {{ old('gender', $student->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $student->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $student->gender) === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="dob" value="{{ __('Date of Birth') }}"/>
                                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob', $student->dob)" required/>
                            </div>
                            <div>
                                <x-label for="religion" value="{{ __('Religion') }}"/>
                                <select name="religion" id="religion" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a religion</option>
                                    <option value="islam" {{ old('religion', $student->religion) === 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="christianity" {{ old('religion', $student->religion) === 'christianity' ? 'selected' : '' }}>Christianity</option>
                                    <option value="hinduism" {{ old('religion', $student->religion) === 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                                    <option value="buddhism" {{ old('religion', $student->religion) === 'buddhism' ? 'selected' : '' }}>Buddhism</option>
                                    <option value="judaism" {{ old('religion', $student->religion) === 'judaism' ? 'selected' : '' }}>Judaism</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="cast" value="{{ __('Cast') }}"/>
                                <x-input id="cast" class="block mt-1 w-full" type="text" name="cast" :value="old('cast', $student->cast)" required/>
                            </div>
                            <div>
                                <x-label for="mobile_no" value="{{ __('Mobile No') }}"/>
                                <x-input id="mobile_no" class="block mt-1 w-full" type="text" name="mobile_no" :value="old('mobile_no', $student->mobile_no)" required/>
                            </div>
                            <div>
                                <x-label for="email" value="{{ __('Email') }}"/>
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $student->email)" required/>
                            </div>
                            <div>
                                <x-label for="admission_date" value="{{ __('Admission Date') }}"/>
                                <x-input id="admission_date" class="block mt-1 w-full" max="{{ date('Y-m-d') }}" type="date" name="admission_date" :value="old('admission_date', $student->admission_date)" required/>
                            </div>
                            <div>
                                <x-label for="blood_group_id" value="{{ __('Blood Group') }}"/>
                                <select name="blood_group_id" id="blood_group_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a blood group</option>
                                    @foreach (\App\Models\BloodGroup::all() as $bg)
                                        <option value="{{ $bg->id }}" {{ old('blood_group_id', $student->blood_group_id) == $bg->id ? 'selected' : '' }}>
                                            {{ $bg->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="house" value="{{ __('House') }}"/>
                                <select name="house" id="house" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a house</option>
                                    <option value="red" {{ old('house', $student->house) === 'red' ? 'selected' : '' }} style="color: red;">Red House</option>
                                    <option value="blue" {{ old('house', $student->house) === 'blue' ? 'selected' : '' }} style="color: blue;">Blue House</option>
                                    <option value="green" {{ old('house', $student->house) === 'green' ? 'selected' : '' }} style="color: green;">Green House</option>
                                    <option value="yellow" {{ old('house', $student->house) === 'yellow' ? 'selected' : '' }} style="color: yellow;">Yellow House</option>
                                    <option value="orange" {{ old('house', $student->house) === 'orange' ? 'selected' : '' }} style="color: orange;">Orange House</option>
                                    <option value="purple" {{ old('house', $student->house) === 'purple' ? 'selected' : '' }} style="color: purple;">Purple House</option>
                                    <option value="pink" {{ old('house', $student->house) === 'pink' ? 'selected' : '' }} style="color: pink;">Pink House</option>
                                    <option value="brown" {{ old('house', $student->house) === 'brown' ? 'selected' : '' }} style="color: brown;">Brown House</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="height" value="{{ __('Height') }}"/>
                                <x-input id="height" class="block mt-1 w-full" type="text" name="height" :value="old('height', $student->height)" required/>
                            </div>
                            <div>
                                <x-label for="weight" value="{{ __('Weight') }}"/>
                                <x-input id="weight" class="block mt-1 w-full" type="text" name="weight" :value="old('weight', $student->weight)" required/>
                            </div>
                            <div>
                                <x-label for="measure_date" value="{{ __('Measure Date') }}"/>
                                <x-input id="measure_date" class="block mt-1 w-full" type="date" name="measure_date" :value="old('measure_date', $student->measure_date)" required/>
                            </div>
                            <div>
                                <x-label for="fees_discount" value="{{ __('Fees Discount') }}"/>

                                <select name="fees_discount" id="fees_discount" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select an option</option>
                                    <option value="1" {{ old('fees_discount', $student->fees_discount) == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('fees_discount', $student->fees_discount) == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">



                            <div>
                                <x-label for="medical_history" value="{{ __('Medical History') }}"/>
                                <textarea name="medical_history" id="medical_history" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{$student->medical_history}}</textarea>
                            </div>

                            <div>
                                <x-label for="is_migrated" value="{{ __('Student Is Migrated From Another Institute') }}" />
                                <select name="is_migrated" id="is_migrated" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select an option</option>
                                    <option value="1" {{ old('is_migrated', $student->is_migrated) == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_migrated', $student->is_migrated) == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="status" value="{{ __('Status') }}" />
                                <select name="status_name" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a student status</option>
                                    <option value="In-Process" {{ old('status_name', $student->latestStatus->name) == 'In-Process' ? 'selected' : '' }} >In-Process</option>
                                    <option value="Approved" {{ old('status_name', $student->latestStatus->name) == 'Approved' ? 'selected' : '' }} >Approved</option>
                                    <option value="Rusticated" {{ old('status_name', $student->latestStatus->name) == 'Rusticated' ? 'selected' : '' }} >Rusticated</option>
                                    <option value="Leaved" {{ old('status_name', $student->latestStatus->name) == 'Leaved' ? 'selected' : '' }} >Leaved</option>
                                </select>
                            </div>

                            <div>
                                {{--                                <x-label for="student_pic" value="{{ __('Student Picture') }}"/>--}}
                                @if(!empty($student->student_pic))
                                    <div class="mt-2">
                                        @if ($student->student_pic)
                                            <img src="{{ Storage::url($student->student_pic) }}" alt="Mother's Picture" style="width: 150px; height: 150px; border: 1px solid #000;">
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                @endif
                                <x-input id="student_pic" class="block mt-1 w-full" type="file" name="student_pic_1"/>
                            </div>


                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4" id="submit-btn"> {{ __('Update Student') }} </x-button>
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