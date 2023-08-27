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

            <a href="{{ route('payment.create') }}"
               class="flex items-center px-4 py-1.5 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2">
                Generate New Challan
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
                <livewire:class-section/>

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
                                    @if($ft->payment_date)
                                        {{ \Carbon\Carbon::parse($ft->payment_date)->format('d-M-Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    @if(!empty($ft->challan_path))
                                        <a href="{{ Storage::url($ft->challan_path) }}">
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

                                    <a href="{{ route('payment.show', $ft->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-center mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
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
