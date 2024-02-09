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
            {{ __('Challans') }}
        </h2>

        <div class="flex justify-center items-center float-right">

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


            <form method="GET" action="{{ route('payment.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">


                    <div>
                        <div>
                            <label for="challan_no">Challan No</label>
                            <input type="number" id="challan_no" name="filter[id]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ request('filter.id') }}">
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="student_id">Student ID</label>
                            <input type="number" id="student_id" name="filter[student.id]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ request('filter.student_id') }}">
                        </div>
                    </div>


                    <div>
                        <label for="status">Status</label>
                        <select name="filter[status]" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a challan status</option>
                            <option value="Paid">Paid</option>
                            <option value="UnPaid">Un-Paid</option>
                            <option value="Canceled">Canceled</option>
                        </select>
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-b ">
                <div class=" bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl rounded-b  dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-white uppercase bg-gray-700 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="border px-0.5 py-2  border-black font-medium text-center dark:text-white">
                                ID
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Issue Date
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Due Date
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Amount
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Fine
                            </th>


                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Paid Amount
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Payment Date
                            </th>

                            <th scope="col" class="px-1 py-2 border border-black  text-center">
                                Scanned Copy
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


                        @foreach ($challans as $ft)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    <a href="{{ route('payment.show', $ft->id) }}" class="underline text-blue-700">{{ $ft->id }}</a>
                                </td>

                                <td class="px-1 py-3 border border-black text-center">
                                    {{ \Carbon\Carbon::parse($ft->payments->min('issue_date'))->format('d-M-Y') }}
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($ft->payments->min('due_date'))->format('d-M-Y') }}
                                </td>
                                <td class="px-1 py-3 border border-black text-center">
                                    {{ number_format($ft->payments->sum('amount'),2) }}
                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    {{ number_format($ft->payments->sum('fine'),2) }}
                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    {{ number_format($ft->payment_amount,2) }}
                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    @if($ft->payment_date)
                                        {{ \Carbon\Carbon::parse($ft->payment_date)->format('d-M-Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    @if(!empty($ft->payment_scanned_path))
                                        <a href="{{ Storage::url($ft->payment_scanned_path) }}" target="_blank" class="underline text-blue-500">
                                            View
                                        </a>
                                    @else
                                        N/A
                                    @endif

                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    {{ $ft->status }}
                                </td>


                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">

                                    @if($ft->status == "UnPaid")
                                        <a href="{{ route('payment.edit', $ft->id) }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                    <div class="@if(!empty($challans->links())) px-4 py-2 @endif">
                        {{ $challans->links() }}
                    </div>


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
