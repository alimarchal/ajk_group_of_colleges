<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right"> <a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a> </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="mr-2"> <a href="{{ route('student.create') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Student Profile</a> </li>
                        <li class="mr-2"> <a href="javascript:;" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Guardian</a> </li>
                        <li class="mr-2"> <a href="javascript:;" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Settings</a> </li>
                        <li class="mr-2"> <a href="javascript:;" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Contacts</a> </li>
                    </ul>
                </div>
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4" />
                    <x-status-message class="mb-4" />
                    <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data"> @csrf <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                            <div>
                                <x-label for="admission_no" value="{{ __('Admission No') }}" />
                                <x-input id="admission_no" class="block mt-1 w-full" type="text" name="admission_no" :value="old('admission_no')"   />
                            </div>
                            <div>
                                <x-label for="roll_no" value="{{ __('Roll No') }}" />
                                <x-input id="roll_no" class="block mt-1 w-full" type="text" name="roll_no" :value="old('roll_no')" required  />
                            </div>
                            <div>
                                <x-label for="institute_class_id" value="{{ __('Institute Class') }}" /> <!-- Add your select input for institute_class_id here --> <select name="institute_class_id" id="institute_class_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a class</option> @foreach (\App\Models\InstituteClass::all() as $ic) <option value="{{ $ic->id }}" {{ old('institute_class_id') == $ic->id ? 'selected' : '' }}>{{ $ic->name }} - {{ $ic->code }}</option> @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="section_id" value="{{ __('Section') }}" /> <!-- Add your select input for section_id here --> <select name="section_id" id="section_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a section</option> @foreach (\App\Models\Section::all() as $section) <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option> @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="category_id" value="{{ __('Category') }}" /> <!-- Add your select input for category_id here --> <select name="category_id" id="category_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a category</option> @foreach (\App\Models\Category::all() as $cat) <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option> @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="firstname" value="{{ __('First Name') }}" />
                                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required  />
                            </div>
                            <div>
                                <x-label for="lastname" value="{{ __('Last Name') }}" />
                                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required  />
                            </div>
                            <div>
                                <x-label for="gender" value="{{ __('Gender') }}" /> <!-- Add your select input for gender here --> <select name="gender" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a gender</option>
                                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="dob" value="{{ __('Date of Birth') }}" />
                                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required  />
                            </div>

                            <div>
                                <x-label for="religion" value="{{ __('Religion') }}" />
                                <!-- Add your select input for religion with sects here -->
                                <select name="religion" id="religion" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a religion</option>
                                    <option value="islam" {{ old('religion') === 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="christianity" {{ old('religion') === 'christianity' ? 'selected' : '' }}>Christianity</option>
                                    <option value="hinduism" {{ old('religion') === 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                                    <option value="buddhism" {{ old('religion') === 'buddhism' ? 'selected' : '' }}>Buddhism</option>
                                    <option value="judaism" {{ old('religion') === 'judaism' ? 'selected' : '' }}>Judaism</option>
                                </select>
                            </div>


                            <div>
                                <x-label for="cast" value="{{ __('Cast') }}" />
                                <x-input id="cast" class="block mt-1 w-full" type="text" name="cast" :value="old('cast')" required  />
                            </div>
                            <div>
                                <x-label for="mobile_no" value="{{ __('Mobile No') }}" />
                                <x-input id="mobile_no" class="block mt-1 w-full" type="text" name="mobile_no" :value="old('mobile_no')" required  />
                            </div>
                            <div>
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required  />
                            </div>
                            <div>
                                <x-label for="admission_date" value="{{ __('Admission Date') }}" />
                                <x-input id="admission_date" class="block mt-1 w-full" max="{{ date('Y-m-d') }}" type="date" name="admission_date" :value="old('admission_date')" required  />
                            </div>
                            <div>
                                <x-label for="blood_group_id" value="{{ __('Blood Group') }}" /> <!-- Add your select input for blood_group_id here --> <select name="blood_group_id" id="blood_group_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a blood group</option> @foreach (\App\Models\BloodGroup::all() as $bg) <option value="{{ $bg->id }}" {{ old('blood_group_id') == $bg->id ? 'selected' : '' }}>{{ $bg->name }}</option> @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="house" value="{{ __('House') }}" /> <!-- Add your select input for house with color values here -->
                                <select name="house" id="house" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a house</option>
                                    <option value="red" {{ old('house') === 'red' ? 'selected' : '' }} style="color: red;">Red House</option>
                                    <option value="blue" {{ old('house') === 'blue' ? 'selected' : '' }} style="color: blue;">Blue House</option>
                                    <option value="green" {{ old('house') === 'green' ? 'selected' : '' }} style="color: green;">Green House</option>
                                    <option value="yellow" {{ old('house') === 'yellow' ? 'selected' : '' }} style="color: yellow;">Yellow House</option>
                                    <option value="orange" {{ old('house') === 'orange' ? 'selected' : '' }} style="color: orange;">Orange House</option>
                                    <option value="purple" {{ old('house') === 'purple' ? 'selected' : '' }} style="color: purple;">Purple House</option>
                                    <option value="pink" {{ old('house') === 'pink' ? 'selected' : '' }} style="color: pink;">Pink House</option>
                                    <option value="brown" {{ old('house') === 'brown' ? 'selected' : '' }} style="color: brown;">Brown House</option> <!-- Add more color options as needed -->
                                </select>
                            </div>
                            <div>
                                <x-label for="height" value="{{ __('Height') }}" />
                                <x-input id="height" class="block mt-1 w-full" type="text" name="height" :value="old('height')" required  />
                            </div>
                            <div>
                                <x-label for="weight" value="{{ __('Weight') }}" />
                                <x-input id="weight" class="block mt-1 w-full" type="text" name="weight" :value="old('weight')" required  />
                            </div>
                            <div>
                                <x-label for="measure_date" value="{{ __('Measure Date') }}" />
                                <x-input id="measure_date" class="block mt-1 w-full" type="date" name="measure_date" :value="old('measure_date')" required  />
                            </div>
                            <div>
                                <x-label for="fees_discount" value="{{ __('Fees Discount') }}" />
                                <select name="fees_discount" id="fees_discount" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select an option</option>
                                    <option value="1" {{ old('fees_discount') === '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('fees_discount') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-label for="medical_history" value="{{ __('Medical History') }}" /> <textarea name="medical_history" id="medical_history" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>
                            <div>
                                <x-label for="student_pic_1" value="{{ __('Student Picture') }}" />
                                <x-input id="student_pic_1" class="block mt-1 w-full" type="file" name="student_pic" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to generate challan?')"> {{ __('Add Student & Next') }} </x-button>
                        </div>
                    </form>
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