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
            <div class="bg-white dark:bg-gray-800 overflow-hidden ">
                <div class=" bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
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
                                    {{ $ft->id }}
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

                                    <a href="{{ route('payment.show', $ft->id) }}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-center mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>

                                    </a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                    {{ $challans->links() }}


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
