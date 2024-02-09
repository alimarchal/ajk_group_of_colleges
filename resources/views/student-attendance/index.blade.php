<x-app-layout>
    @push('custom_headers')
        <link rel="stylesheet" href="{{ url('scripts/daterangepicker.min.css') }}">
        <script src="{{ url('scripts/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ url('scripts/moment.min.js') }}"></script>
        <script src="{{ url('scripts/knockout-3.5.1.js') }}" defer></script>
        <script src="{{ url('scripts/daterangepicker.min.js') }}" defer></script>
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
                <form method="GET" action="{{ route('feeType.index') }}">
                    <livewire:attendance />
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
                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Student Name
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Class
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Section
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center print:hidden">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center print:hidden">
                                Attendance Status
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($students as $student)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $student->firstname }} {{ $student->lastname }}
                                </td>

                                <td class="px-1 py-3 border border-black text-center">
                                    {{ $student->instituteClass->name }}
                                </td>


                                <td class="px-1 py-3 border border-black text-center">
                                    {{ $student->section->name }}
                                </td>


                                <td class="px-1 py-3 border border-black text-center">
                                    {{ \Carbon\Carbon::now()->format('d-M-Y')  }}
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">

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
