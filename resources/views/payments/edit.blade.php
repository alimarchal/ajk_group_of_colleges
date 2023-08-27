<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right"><a href="{{ route('feeType.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4"/>
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>
                    <form method="POST" action="{{ route('feeType.update', $feeType->id) }}">
                        @csrf
                        @method('PUT')


                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-4">
                            <div>
                                <x-label for="amount" value="{{ __('Amount') }}"/>
                                <x-input id="amount" class="block mt-1 w-full" type="number" step="0.01" min="0.00" name="amount" :value="old('amount', $feeType->amount)"/>
                            </div>

                            <div>
                                <x-label for="is_recurring" value="{{ __('Is Recurring') }}"/>
                                <select required name="is_recurring" id="is_recurring" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a recurring</option>
                                    <option value="1" @if($feeType->is_recurring == 1) selected @endif>Yes</option>
                                    <option value="0" @if($feeType->is_recurring == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="frequency" value="{{ __('Frequency') }}"/>
                                <select required name="frequency" id="frequency" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a frequency</option>
                                    <option value="Monthly" @if($feeType->frequency == 'Monthly') selected @endif>Monthly</option>
                                    <option value="Quarterly" @if($feeType->frequency == 'Quarterly') selected @endif>Quarterly</option>
                                    <option value="Annually" @if($feeType->frequency == 'Annually') selected @endif>Annually</option>
                                    <option value="One Time" @if($feeType->frequency == 'One Time') selected @endif>One Time</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4">
                            <div>
                                <x-label for="status" value="{{ __('Status') }}"/>
                                <select required name="status" id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a status</option>
                                    <option value="1" @if($feeType->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($feeType->status == 0) selected @endif>In-Active</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <textarea id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="description">{{ old('description', $feeType->description) }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">{{ __('Update') }}</x-button>
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