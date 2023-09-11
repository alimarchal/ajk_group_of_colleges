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
                <div class="px-6 mb-4 lg:px-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>

                    @if(!empty($student->emergencyContact))


                        <form method="POST" action="{{ route('student.guardians.alerts.update', $student->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <!-- Home Number Emergency Contact -->
                                <div>
                                    <x-label for="home_number_emergency_contact" value="{{ __('Home Number Emergency Contact') }}"/>
                                    <x-input id="home_number_emergency_contact" class="block mt-1 w-full" type="text" name="home_number_emergency_contact" :value="old('home_number_emergency_contact', $student->emergencyContact->home_number_emergency_contact)"/>
                                </div>
                                <!-- Phone Network -->
                                <div>
                                    <x-label for="phone_network_id" value="{{ __('Phone Network') }}"/>
                                    <select name="phone_network_id" id="phone_network_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select a phone network</option>
                                        <!-- Add your options here -->
                                        @foreach(\App\Models\PhoneNetwork::all() as $mn)
                                            <option value="{{ $mn->id }}" {{ $student->emergencyContact->phone_network_id == $mn->id ? 'selected' : '' }}>{{ $mn->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Mobile Number for SMS Alert -->
                                <div>
                                    <x-label for="mobile_number_for_sms_alert" value="{{ __('Mobile Number for SMS Alert') }}"/>
                                    <x-input id="mobile_number_for_sms_alert" class="block mt-1 w-full" type="text" name="mobile_number_for_sms_alert" :value="old('mobile_number_for_sms_alert', $student->emergencyContact->mobile_number_for_sms_alert)"/>
                                </div>
                                <!-- Email Address for School Report -->
                                <div>
                                    <x-label for="email_address_for_school_report" value="{{ __('Email Address for School Report') }}"/>
                                    <x-input id="email_address_for_school_report" class="block mt-1 w-full" type="email" name="email_address_for_school_report" :value="old('email_address_for_school_report', $student->emergencyContact->email_address_for_school_report)"/>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4" id="submit-btn">{{ __('Update Guardian Alert Contacts') }}</x-button>
                            </div>
                        </form>

                    @else

                        <form method="POST" action="{{ route('student.guardians.alerts.store', $student->id) }}">
                            @csrf
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <!-- Home Number Emergency Contact -->
                                <div>
                                    <x-label for="home_number_emergency_contact" value="{{ __('Home Number Emergency Contact') }}"/>
                                    <x-input id="home_number_emergency_contact" class="block mt-1 w-full" type="text" name="home_number_emergency_contact" :value="old('home_number_emergency_contact')"/>
                                </div>
                                <!-- Phone Network -->
                                <div>
                                    <x-label for="phone_network_id" value="{{ __('Phone Network') }}"/>
                                    <select name="phone_network_id" id="phone_network_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select a phone network</option>
                                        <!-- Add your options here -->
                                        @foreach(\App\Models\PhoneNetwork::all() as $mn)
                                            <option value="{{ $mn->id }}">{{ $mn->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Mobile Number for SMS Alert -->
                                <div>
                                    <x-label for="mobile_number_for_sms_alert" value="{{ __('Mobile Number for SMS Alert') }}"/>
                                    <x-input id="mobile_number_for_sms_alert" class="block mt-1 w-full" type="text" name="mobile_number_for_sms_alert" :value="old('mobile_number_for_sms_alert')"/>
                                </div>
                                <!-- Email Address for School Report -->
                                <div>
                                    <x-label for="email_address_for_school_report" value="{{ __('Email Address for School Report') }}"/>
                                    <x-input id="email_address_for_school_report" class="block mt-1 w-full" type="email" name="email_address_for_school_report" :value="old('email_address_for_school_report')"/>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to create guardian alert contacts?')">{{ __('Update Guardian Alert Contacts & Next') }}</x-button>
                            </div>
                        </form>

                    @endif
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