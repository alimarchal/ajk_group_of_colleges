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
            {{ __('Students') }}
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="#"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2">
                New Admission
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
    <div class="max-w-7xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 print:hidden" style="display: none" id="filters">
        <div class="rounded-xl p-4 bg-white shadow-lg">
            <form action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                               for="name">Name</label>
                        <input id="name" type="text" name="filter[name]" value="{{ request('filter.name') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                               for="email">Email</label>
                        <input id="email" type="text" name="filter[email]" value="{{ request('filter.email') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="mobile_no">Mobile
                            No</label>
                        <input id="mobile_no" type="text" name="filter[mobile_no]"
                               value="{{ request('filter.mobile_no') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="license_number">License
                            Number</label>
                        <input id="license_number" type="text" name="filter[license_number]"
                               value="{{ request('filter.license_number') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                               for="cnic">CNIC</label>
                        <input id="cnic" type="text" name="filter[cnic]" value="{{ request('filter.cnic') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>
                    <div>
                    </div>


                    <div class="flex items-center justify-between">
                        <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                            Search
                        </button>
                    </div>

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

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                RID
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Consumer Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                CNIC No
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDIV
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center print:hidden">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>



                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                   0
                                </th>


                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                    0
                                </th>


                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                    0
                                </th>



                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                    0
                                </th>


                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                    0
                                </th>


                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                    0
                                </th>



                                <th class="border px-0.5 py-0.5  border-black font-medium text-black text-center dark:text-white">
                                    0
                                </th>


                                <th class="border px-0.5 py-0.5 border-black font-medium text-center text-black dark:text-white print:hidden">
{{--                                    redirectToLink('{{ route('testReport.show', $test_report->id) }}')--}}
                                    <button onclick=""
                                            class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                                            title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>



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
