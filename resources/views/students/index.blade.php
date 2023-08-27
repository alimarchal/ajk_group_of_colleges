<x-app-layout>
    @push('custom_headers')
        <link rel="stylesheet" href="https://cms.ajkced.gok.pk/daterange/daterangepicker.min.css">
        <script src="https://cms.ajkced.gok.pk/daterange/jquery-3.6.0.min.js"></script>
        <script src="https://cms.ajkced.gok.pk/daterange/moment.min.js"></script>
        <script src="https://cms.ajkced.gok.pk/daterange/knockout-3.5.1.js" defer></script>
        <script src="https://cms.ajkced.gok.pk/daterange/daterangepicker.min.js" defer></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Student') }}
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="{{ route('student-information.index') }}"
               class="flex items-center px-4 py-1.5 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2">
                Back
            </a>

            <a href="javascript:;" id="toggle"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
               title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </a>

        </div>

    </x-slot>
    <div class="max-w-8xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 print:hidden " style="display: none" id="filters">
        <div class="rounded-xl p-4 bg-white shadow-lg">



            <form method="GET" action="{{ route('student.index') }}">
                <div class="mt-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Admission No -->
                    <div>
                        <x-label for="admission_no" value="{{ __('Admission No') }}" />
                        <x-input id="admission_no" class="block mt-1 w-full" type="text" name="filter[admission_no]" value="{{ request('filter.admission_no') }}" />
                    </div>

                    <!-- Roll No -->
                    <div>
                        <x-label for="roll_no" value="{{ __('Roll No') }}" />
                        <x-input id="roll_no" class="block mt-1 w-full" type="text" name="filter[roll_no]" value="{{ request('filter.roll_no') }}" />
                    </div>

                    <!-- Institute Class -->
                    <div>
                        <x-label for="institute_class_id" value="{{ __('Institute Class') }}" />
                        <select name="filter[instituteClass.id]" id="institute_class_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a class</option>
                            @foreach (\App\Models\InstituteClass::all() as $ic)
                                <option value="{{ $ic->id }}" {{ request('filter.instituteClass.id') == $ic->id ? 'selected' : '' }}>
                                    {{ $ic->name }} - {{ $ic->code }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Section -->
                    <div>
                        <x-label for="section_id" value="{{ __('Section') }}" />
                        <select name="filter[section.id]" id="section_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a section</option>
                            @foreach (\App\Models\Section::all() as $section)
                                <option value="{{ $section->id }}" {{ request('filter.section.id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div>
                        <x-label for="category_id" value="{{ __('Category') }}" />
                        <select name="filter[category.id]" id="category_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a category</option>
                            @foreach (\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}" {{ request('filter.category.id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- First Name -->
                    <div>
                        <x-label for="firstname" value="{{ __('First Name') }}" />
                        <x-input id="firstname" class="block mt-1 w-full" type="text" name="filter[firstname]" value="{{ request('filter.firstname') }}" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-label for="lastname" value="{{ __('Last Name') }}" />
                        <x-input id="lastname" class="block mt-1 w-full" type="text" name="filter[lastname]" value="{{ request('filter.lastname') }}" />
                    </div>

                    <!-- Gender -->
                    <div>
                        <x-label for="gender" value="{{ __('Gender') }}" />
                        <select name="filter[gender]" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a gender</option>
                            <option value="Male" {{ request('filter.gender') === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('filter.gender') === 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ request('filter.gender') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select name="filter[latestStatus.name]" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a student status</option>
                            <option value="In-Process" {{ request('filter.status.name') === 'In-Process' ? 'selected' : '' }}>In-Process</option>
                            <option value="Approved" {{ request('filter.status.name') === 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rusticated" {{ request('filter.status.name') === 'Rusticated' ? 'selected' : '' }}>Rusticated</option>
                            <option value="Leaved" {{ request('filter.status.name') === 'Leaved' ? 'selected' : '' }}>Leaved</option>
                        </select>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <x-label for="dob" value="{{ __('Date of Birth') }}" />
                        <x-input id="dob" class="block mt-1 w-full" type="date" name="filter[dob]" value="{{ request('filter.dob') }}" />
                    </div>

                    <!-- Religion -->
                    <div>
                        <x-label for="religion" value="{{ __('Religion') }}" />
                        <select name="filter[religion]" id="religion" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a religion</option>
                            <option value="islam" {{ request('filter.religion') === 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="christianity" {{ request('filter.religion') === 'christianity' ? 'selected' : '' }}>Christianity</option>
                            <option value="hinduism" {{ request('filter.religion') === 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                            <option value="buddhism" {{ request('filter.religion') === 'buddhism' ? 'selected' : '' }}>Buddhism</option>
                            <option value="judaism" {{ request('filter.religion') === 'judaism' ? 'selected' : '' }}>Judaism</option>
                        </select>
                    </div>

                    <!-- Cast -->
                    <div>
                        <x-label for="cast" value="{{ __('Cast') }}" />
                        <x-input id="cast" class="block mt-1 w-full" type="text" name="filter[cast]" value="{{ request('filter.cast') }}" />
                    </div>

                    <!-- Mobile No -->
                    <div>
                        <x-label for="mobile_no" value="{{ __('Mobile No') }}" />
                        <x-input id="mobile_no" class="block mt-1 w-full" type="text" name="filter[mobile_no]" value="{{ request('filter.mobile_no') }}" />
                    </div>


                    <!-- Admission Date -->
                    <div>
                        <x-label for="admission_date" value="{{ __('Admission Date') }}" />
                        <x-input id="admission_date" class="block mt-1 w-full" max="{{ date('Y-m-d') }}" type="date" name="filter[admission_date]" value="{{ request('filter.admission_date') }}" />
                    </div>

                    <!-- Blood Group -->
                    <div>
                        <x-label for="blood_group_id" value="{{ __('Blood Group') }}" />
                        <select name="filter[bloodGroup.id]" id="blood_group_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a blood group</option>
                            @foreach (\App\Models\BloodGroup::all() as $bg)
                                <option value="{{ $bg->id }}" {{ request('filter.bloodGroup.id') == $bg->id ? 'selected' : '' }}>
                                    {{ $bg->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fees Discount -->
                    <div>
                        <x-label for="fees_discount" value="{{ __('Fees Discount') }}" />
                        <select name="filter[fees_discount]" id="fees_discount" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select an option</option>
                            <option value="1" {{ request('filter.fees_discount') === '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ request('filter.fees_discount') === '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>


                    <!-- Father Name -->
                    <div>
                        <x-label for="father_name" value="{{ __('Father Name') }}" />
                        <x-input id="father_name" class="block mt-1 w-full" type="text" name="filter[guardian.father_name]" value="{{ request('filter.father_name') }}" />
                    </div>

                    <!-- Father Phone -->
                    <div>
                        <x-label for="father_phone" value="{{ __('Father Phone') }}" />
                        <x-input id="father_phone" class="block mt-1 w-full" type="text" name="filter[guardian.father_phone]" value="{{ request('filter.father_phone') }}" />
                    </div>

                    <!-- Father Occupation -->
                    <div>
                        <x-label for="father_occupation" value="{{ __('Father Occupation') }}" />
                        <x-input id="father_occupation" class="block mt-1 w-full" type="text" name="filter[guardian.father_occupation]" value="{{ request('filter.father_occupation') }}" />
                    </div>

                    <!-- Mother Name -->
                    <div>
                        <x-label for="mother_name" value="{{ __('Mother Name') }}" />
                        <x-input id="mother_name" class="block mt-1 w-full" type="text" name="filter[guardian.mother_name]" value="{{ request('filter.mother_name') }}" />
                    </div>

                    <!-- Mother Phone -->
                    <div>
                        <x-label for="mother_phone" value="{{ __('Mother Phone') }}" />
                        <x-input id="mother_phone" class="block mt-1 w-full" type="text" name="filter[guardian.mother_phone]" value="{{ request('filter.mother_phone') }}" />
                    </div>

                    <!-- Guardian Name -->
                    <div>
                        <x-label for="guardian_name" value="{{ __('Guardian Name') }}" />
                        <x-input id="guardian_name" class="block mt-1 w-full" type="text" name="filter[guardian.guardian_name]" value="{{ request('filter.guardian_name') }}" />
                    </div>

                    <!-- Guardian Relation -->
                    <div>
                        <x-label for="guardian_relation" value="{{ __('Guardian Relation') }}" />
                        <x-input id="guardian_relation" class="block mt-1 w-full" type="text" name="filter[guardian.guardian_relation]" value="{{ request('filter.guardian_relation') }}" />
                    </div>

                    <!-- Guardian Phone -->
                    <div>
                        <x-label for="guardian_phone" value="{{ __('Guardian Phone') }}" />
                        <x-input id="guardian_phone" class="block mt-1 w-full" type="text" name="filter[guardian.guardian_phone]" value="{{ request('filter.guardian_phone') }}" />
                    </div>

                    <!-- Guardian Email -->
                    <div>
                        <x-label for="guardian_email" value="{{ __('Guardian Email') }}" />
                        <x-input id="guardian_email" class="block mt-1 w-full" type="email" name="filter[guardian.guardian_email]" value="{{ request('filter.guardian_email') }}" />
                    </div>

                </div>

                <div class="mt-4">
                    <x-button class="bg-indigo-500 text-white">
                        {{ __('Apply Filters') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden ">
                <div class=" bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                Admission No
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Student Name
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Class
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Father Name
                            </th>


                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Date Of Birth
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Gender
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Category
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center print:hidden">
                                Mobile Number
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center print:hidden">
                                Status
                            </th>


                            <th scope="col" class="px-1 py-2 border border-black  text-center print:hidden">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($students as $student)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $student->admission_no }}
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $student->firstname }} {{ $student->lastname }}
                                </td>

                                <td class="px-1 py-3 border border-black text-center">
                                    {{ $student->instituteClass->name }}
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    @if(!empty($student->guardian))
                                        {{ $student->guardian->father_name }}
                                    @else
                                        Missing
                                    @endif

                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($student->dob)->format('Y-m-d') }} {{-- Format the date of birth as needed --}}
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $student->gender }}
                                </td>

                                <td class="px-1 py-3 border border-black text-center">
                                    {{ $student->category->name }}
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    {{ $student->mobile_no }}
                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    @if(!empty($student->latestStatus))
                                        {{ $student->latestStatus->name }}
                                    @endif

                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">

{{--                                    <a href="javascript:;" id="toggle"--}}
{{--                                       class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"--}}
{{--                                       title="Members List">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"--}}
{{--                                             stroke="currentColor">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}




                                    <a href="{{ route('student.show', $student->id) }}" class="inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('student.print', $student->id) }}" class="inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach






                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
    @push('modals')
        <script>

            const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");
            btn.onclick = function () {
                if (targetDiv.style.display !== "none") {
                    targetDiv.style.display = "none";
                } else {
                    targetDiv.style.display = "block";
                }
            };

            function redirectToLink(url) {
                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
