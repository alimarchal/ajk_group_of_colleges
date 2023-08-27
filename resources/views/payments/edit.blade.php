<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> Update Challan Status </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('payment.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4"> Back </a></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4"/>
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>
                    <form method="POST" action="{{ route('payment.update', $challan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-6">

                            <div>
                                <x-label for="payment_date" value="{{ __('Payment Date') }}"/>
                                <x-input id="payment_date" required  class="block mt-1 w-full" max="{{ date('Y-m-d') }}" type="date" name="payment_date" />
                            </div>

                            <div>
                                <x-label for="payment_amount" value="{{ __('Paid Amount') }}"/>
                                <x-input id="payment_amount" required  class="block mt-1 w-full" type="number" step="0.01" min="0.00" name="payment_amount" />
                            </div>

                            <div>
                                <x-label for="status" value="Status"/>
                                <select required name="status"  id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="challan_scanned_copy" required  value="{{ __('Scanned Copy') }}"/>
                                <x-input id="challan_scanned_copy" class="block mt-1 w-full" type="file" name="challan_scanned_copy" />
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