<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Generate New Challan') }} </h2>
        <div class="flex justify-center items-center float-right"><a href="{{ route('feeType.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4"/>
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>

                    <form method="POST" action="{{ route('payment.store') }}">
                        @csrf

{{--                        <livewire:class-and-section-select/>--}}

                        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 mt-4 pt-2">

                            <div>
                                <label for="fee_type_id">Fee Type</label>
                                <select name="fee_type_id" required id="fee_type_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select a fee type</option>
                                    @foreach(\App\Models\FeeType::all() as $fc)
                                        <option value="{{ $fc->id }}">{{ $fc->feeCategory->name }} - {{ $fc->instituteClass->name }} / {{ $fc->section->name }} - {{ $fc->amount }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="student_id">Student ID</label>
                                <input type="text" id="student_id" name="student_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="{{ old('student_id') }}">
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
                            <x-button class="ml-4">{{ __('Submit') }}</x-button>
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