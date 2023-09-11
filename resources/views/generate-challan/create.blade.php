<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right"><a href="{{ route('student.index') }}" class="flex items-center px-4 py-1 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">


                <x-status-message class="mb-4"/>
                <x-student-tabs :student="$student"/>
                <div class="mb-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>




                    @if($student->fee_type_carts->isNotEmpty())
                        <div class="">
                        <table class="w-full text-sm border-collapse rounded-lg	 border border-slate-400 text-left text-black dark:text-gray-400 mt-0.5">
                            <thead class="uppercase bg-gray-700 text-white dark:bg-gray-700">
                            <tr>

                                <th scope="col" class="border py-2  border-black font-medium text-center dark:text-white">
                                    ID
                                </th>

                                <th scope="col" class="px-1 py-2 border border-black  text-center">
                                    Fee Type
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
                                    Discount
                                </th>


                                <th scope="col" class="px-1 py-1 border border-black  text-center print:hidden">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($student->fee_type_carts as $ft)
                                <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white">
                                        {{ $ft->feeType->feeCategory->name }}
                                    </td>

                                    <td class="px-1 py-1 border border-black text-center">
                                        {{ \Carbon\Carbon::parse($ft->issue_date)->format('d-M-Y') }}
                                    </td>

                                    <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white">
                                        {{ \Carbon\Carbon::parse($ft->due_date)->format('d-M-Y') }}
                                    </td>
                                    <td class="px-1 py-1 border border-black text-center">
                                        {{ $ft->amount }}
                                    </td>


                                    <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white print:hidden">
                                        {{ $ft->fine }}
                                    </td>


                                    <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white print:hidden">
                                        @if($ft->is_discounted == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>

                                    <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white print:hidden">

                                        <form action="{{ route('student.generate-challan.generatedChallanDelete',[ $ft->student_id, $ft->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-green-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 transition ease-in-out duration-150">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach



                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-0.5 py-1  border-black font-medium text-black text-right dark:text-white " colspan="4">
                                    Total Amount:
                                </td>


                                <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    {{ number_format($student->fee_type_carts->sum('amount'),2) }}
                                </td>

                                <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white print:hidden">
                                    {{ number_format($student->fee_type_carts->sum('fine'),2) }}
                                </td>


                                <td class="border px-0.5 py-1  border-black font-medium text-black text-center dark:text-white print:hidden" colspan="2">

                                </td>

                            </tr>



                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-0.5 py-1  border-black font-medium text-black text-left " colspan="8">

                                    <form action="{{ route('student.generate-challan.generateFinalChallan',$ft->student_id ) }}" method="post">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-red-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-white focus:bg-red-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                                            Generate Final Challan
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                        </div>
                    @endif



                    <h1 class="text-xl text-center pt-6 font-bold">Generate Fee Type and Create Challans </h1>
                    <form method="POST" action="{{ route('student.generate-challan.post', $student->id) }}" class="px-6 mt-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-4">

                            <div>
                                <label for="fee_type_id">Fee Type</label>
                                <select name="fee_type_id" required id="fee_type_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a fee type</option>
                                    @foreach($fee_types as $fc)
                                        <option value="{{ $fc->id }}">{{ $fc->feeCategory->name }} - {{ $fc->instituteClass->name }} / {{ $fc->section->name }} - {{ $fc->amount }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div>
                                <label for="discount_type">Discount Type</label>
                                <select name="discount_type" required id="discount_type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="No-Discount" selected>No-Discount</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>

                            <div>
                                <label for="discounted_number">If Discount Type is Flat/Percentage</label>
                                <input type="number" name="discounted_number"  step="0.01" min="0" value="0.00" id="discounted_number" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" >
                            </div>

                            <div>
                                <label for="issue_date">Issue Date</label>
                                <input type="date" id="issue_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" name="issue_date" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ old('issue_date') }}">
                            </div>

                            <div>
                                <label for="due_date">Due Date</label>
                                <input type="date" id="due_date"  min="{{ \Carbon\Carbon::now()->endOfMonth()->addDay(1)->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->endOfMonth()->addDay(5)->format('Y-m-d') }}" name="due_date" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ old('due_date') }}">
                            </div>

                        </div>
                        <div class="flex items-center justify-end mt-2">
                            <x-button class="ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>

                            </x-button>
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