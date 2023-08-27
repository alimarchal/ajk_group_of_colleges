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
                <div class=" px-4 py-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>



                    @if(!empty($student->challans))
                        <table class="w-full text-sm border-collapse rounded-lg	 border border-slate-400 text-left text-black dark:text-gray-400 mt-0.5">
                            <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                            <tr>

                                <th scope="col" class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                    Challan No
                                </th>

                                <th scope="col" class="px-1 py-2 border border-black  text-center">
                                    Issue Date
                                </th>

                                <th scope="col" class="px-1 py-2 border border-black  text-center">
                                    Due Date
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


                            @foreach ($student->challans as $ft)
                                <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                        {{ $ft->id }}
                                    </td>


                                    <td class="px-1 py-3 border border-black text-center">
                                        {{ \Carbon\Carbon::parse($ft->payments->min('issue_date'))->format('d-M-Y') }}
                                    </td>

                                    <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
                                        {{ \Carbon\Carbon::parse($ft->payments->max('due_date'))->format('d-M-Y') }}
                                    </td>


                                    <td class="border px-0.5 py-2  border-black font-medium text-black text-center dark:text-white">
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

                    @endif

                </div>
            </div>
        </div>
    </div>
    @push('modals')
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

