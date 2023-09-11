<x-app-layout>
    @push('custom_headers')
        <style>
            table, td, th {
                /*border: 1px solid;*/
                padding-left: 5px;
            }

            table {
                width: 100%;
                font-size: 12px;
                border-collapse: collapse;
            }
        </style>


        <style>

            @media screen {
                .table_header_print {
                    display: none;
                }
            }

            @media print {
                body {
                    margin: 0;
                    padding: 0;
                }

                .header-print {
                    width: 100%;
                    height: 100px; /* Adjust the height as needed */
                    margin: 0;
                    padding: 0;
                    position: fixed;
                    top: 0;
                    left: 0;
                    background-color: white; /* Set the background color you want */
                }

                .table_header_print {
                    width: 100%;
                }

                .table_header_print td {
                    width: 33.33%;
                    text-align: center; /* Center the content horizontally */
                }

                .table_header_print img {
                    height: 100px;
                }

                table, td, th {
                    /*border: 1px solid;*/
                }

                .qrcode {
                    float: right;
                }
            }

            /* Hide the header on the screen */
            .header-print {
                display: none;
            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ url()->previous() }}"
               class="text-center px-4 py-1.5 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700"
               title="Back">
                Back
            </a>            <button onclick="window.print()" class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2" title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
            </button>
        </div>
    </x-slot>
    <div class="py-1">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden ">
                <x-student-tabs :student="$student"/>
                <div class=" mb-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4"/>
                    <x-status-message class="mb-4"/>

                    <div class="bg-white">

                        <table class="table_header_print" style="margin: 0px;">
                            <tr>
                                <td style="width: 33.33%">
                                    <div style="float: left; margin-left: 40%">
                                        @php $test_report_data = "http://127.0.0.1:8000/testReport/" . $student->id; @endphp
                                        {!! DNS2D::getBarcodeSVG($test_report_data, 'QRCODE',3,3) !!}
                                    </div>
                                </td>
                                <td style="width: 33.33%"><img src="{{ Storage::url('logo.png') }}" alt="Logo" style="margin:auto; height: 100px;"></td>
                                <td style="width: 33.33%; text-align: center;">
                                    <div style="margin: auto; margin-left: 30%">
                                        @if ($student->student_pic)
                                            <img src="{{ Storage::url($student->student_pic) }}" alt="Mother's Picture" style="width: 100px; height: 100px; border: 1px solid #000;">
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>


                        <table style="margin-top: 5px; text-align: center; font-weight: bold;">
                            <tr>
                                <td>Student Information</td>
                            </tr>
                        </table>

                        <table style="margin-top: 2px;">
                            <tr>
                                <td style="font-weight: bold;">Admission Number</td>
                                <td>{{ $student->admission_no }}</td>
                                <td style="font-weight: bold;">Student ID</td>
                                <td>{{ $student->id }}</td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Name</td>
                                <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                                <td style="font-weight: bold;">Gender</td>
                                <td>{{ $student->gender }}</td>
                            </tr>


                            <tr>
                                <td style="font-weight: bold;">Category</td>
                                <td>{{ $student->category->name }}</td>
                                <td style="font-weight: bold;">Date of Birth</td>
                                <td>{{ \Carbon\Carbon::parse($student->dob)->format('d-M-Y') }} -
                                    ({{ \Carbon\Carbon::parse($student->dob)->diff(now())->format('%y years') }})
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Admission Date</td>
                                <td>{{ \Carbon\Carbon::parse($student->admission_date)->format('d-M-Y') }}</td>
                                <td style="font-weight: bold;">Blood Group</td>
                                <td>{{ $student->bloodGroup->name }}</td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Roll Number</td>
                                <td>{{ $student->roll_no }}</td>
                                <td style="font-weight: bold;">Class / Section</td>
                                <td>{{ $student->instituteClass->name }} / {{ $student->section->name }}</td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Religion</td>
                                <td>{{ $student->religion }}</td>
                                <td style="font-weight: bold;">Cast</td>
                                <td>{{ $student->cast }}</td>
                            </tr>


                            <tr>
                                <td style="font-weight: bold;">Mobile Number</td>
                                <td>{{ $student->mobile_no }}</td>
                                <td style="font-weight: bold;">Email</td>
                                <td>{{ $student->email }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">House</td>
                                <td>{{ $student->house }}</td>
                                <td style="font-weight: bold;">Height</td>
                                <td>{{ $student->height }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Weight</td>
                                <td>{{ $student->weight }}</td>
                                <td style="font-weight: bold;">Measurement Date</td>
                                <td>{{ \Carbon\Carbon::parse($student->measure_date)->format('d-M-Y') }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Fees Discount</td>
                                <td>{{ $student->fees_discount }}</td>
                                <td style="font-weight: bold;">Medical History</td>
                                <td>{{ $student->medical_history }}</td>
                            </tr>

                        </table>

                        <hr style="border: 1px solid black; margin-top: 10px;">


                        @if(!empty($student->guardian))
                            <table style="margin-top: 5px; font-size: 18px; text-align: center; font-weight: bold;">
                                <tr>
                                    <td>Father Information</td>
                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <td style="font-weight: bold;">Name</td>
                                    <td>{{ $student->guardian->father_name }}</td>
                                    <td style="font-weight: bold;">Phone</td>
                                    <td>{{ $student->guardian->father_phone }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Occupation</td>
                                    <td>{{ $student->guardian->father_occupation }}</td>

                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>

                            <hr style="border: 1px solid black; margin-top: 10px;">

                            <table style="margin-top: 2px; font-size: 18px; text-align: center; font-weight: bold;">
                                <tr>
                                    <td> Mother Information</td>
                                </tr>
                            </table>

                            <table style="margin-top: 2px;">

                                <tr>
                                    <td style="font-weight: bold;">Name</td>
                                    <td>{{ $student->guardian->mother_name }}</td>
                                    <td style="font-weight: bold;">Phone</td>
                                    <td>{{ $student->guardian->mother_phone }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Occupation</td>
                                    <td>{{ $student->guardian->mother_occupation }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>

                            <hr style="border: 1px solid black; margin-top: 10px;">

                            <table style="margin-top: 2px;  font-size: 18px; text-align: center; font-weight: bold;">
                                <tr>
                                    <td>Guardian Information</td>
                                </tr>
                            </table>

                            <table style="margin-top: 2px;">
                                <tr>
                                    <td style="font-weight: bold;">Relationship</td>
                                    <td>{{ $student->guardian->guardian_relation }}</td>
                                    <td style="font-weight: bold;">Phone</td>
                                    <td>{{ $student->guardian->guardian_phone }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Occupation</td>
                                    <td>{{ $student->guardian->guardian_occupation }}</td>
                                    <td style="font-weight: bold;">Email</td>
                                    <td>{{ $student->guardian->guardian_email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Address</td>
                                    <td colspan="3">{{ $student->guardian->guardian_address }}</td>
                                </tr>
                            </table>

                        @endif

                        <hr style="border: 1px solid black; margin-top: 10px;">
                        @if(!empty($student->emergencyContact))
                            <table style="margin-top: 2px;  font-size: 18px; text-align: center; font-weight: bold;">
                                <tr>
                                    <td>Emergency Contact Information</td>
                                </tr>
                            </table>


                            <table style="margin-top: 2px;">
                                <tr>
                                    <td style="font-weight: bold;">Home Number Emergency Contact</td>
                                    <td>{{ $student->emergencyContact->home_number_emergency_contact }}</td>
                                    <td style="font-weight: bold;">Phone Network</td>
                                    <td>{{ $student->emergencyContact->phoneNetwork->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Mobile Number for SMS Alert</td>
                                    <td>{{ $student->emergencyContact->mobile_number_for_sms_alert }}</td>
                                    <td style="font-weight: bold;">Email Address for School Report</td>
                                    <td>{{ $student->emergencyContact->email_address_for_school_report }}</td>
                                </tr>
                            </table>

                        @endif

                        {{--                        <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">--}}
                        {{--                            <thead class="text-black bg-gray-50 dark:bg-gray-700" style="font-size: 12px;">--}}
                        {{--                            <tr>--}}
                        {{--                                <th class="px-1 py-0.5 border border-black text-left">--}}
                        {{--                                    ID--}}
                        {{--                                </th>--}}
                        {{--                                <th class="px-1 py-0.5 border border-black text-left">--}}
                        {{--                                    Insulation--}}
                        {{--                                </th>--}}
                        {{--                                <th class="px-1 py-0.5 border border-black  text-left">--}}
                        {{--                                    Continuity--}}
                        {{--                                </th>--}}
                        {{--                                <th class="px-1 py-0.5 border border-black  text-left">--}}
                        {{--                                    Earthing--}}
                        {{--                                </th>--}}
                        {{--                            </tr>--}}
                        {{--                            </thead>--}}
                        {{--                            <tbody style="font-size: 12px;">--}}
                        {{--                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">--}}
                        {{--                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">--}}
                        {{--                                    1--}}
                        {{--                                </td>--}}
                        {{--                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">--}}
                        {{--                                    {{ $testReport->insulation }}--}}
                        {{--                                </td>--}}
                        {{--                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">--}}
                        {{--                                    {{ $testReport->continuity }}--}}
                        {{--                                </td>--}}
                        {{--                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">--}}
                        {{--                                    {{ $testReport->earthing }}--}}
                        {{--                                </td>--}}
                        {{--                            </tr>--}}
                        {{--                        </table>--}}
                        {{--                        <div class="grid grid-cols-1 gap-4">--}}
                        {{--                            <div class="mt-1 text-justify p-2" style="border: 1px solid black;font-size: 12px;">--}}
                        {{--                                I / authorized wireman have inspected the connection and charged a fee of--}}
                        {{--                                Rs. {{ number_format($testReport->wc_test_report_fee,  2) }} from the consumer according to--}}
                        {{--                                Govt. notification, I hereby certify that all electrical wiring work has been executed in--}}
                        {{--                                accordance with the--}}
                        {{--                                Electricity Rules, 1937.--}}
                        {{--                                <br>--}}
                        {{--                                <hr class="border-black" style="margin-top: 2px; margin-bottom: 2px;">--}}
                        {{--                                <span class="font-extrabold">--}}
                        {{--                  W/C Name: {{ $testReport->user->name }} /--}}
                        {{--                  D-{{ $testReport->divisionSubDivision->division_name}} /--}}
                        {{--                  SD-{{ $testReport->divisionSubDivision->sub_division_name}}--}}
                        {{--                  </span>--}}
                        {{--                                <br>--}}
                        {{--                                <span class="font-extrabold">--}}
                        {{--                  WCID: {{ $testReport->user->id }}-Created-{{ $testReport->created_at }}  /--}}
                        {{--                  License No: @if(empty($testReport->user->license_number))--}}
                        {{--                                        N/A--}}
                        {{--                                    @else--}}
                        {{--                                        {{ $testReport->user->license_number }}--}}
                        {{--                                    @endif--}}


                        {{--                  </span>--}}
                        {{--                                <br>--}}
                        {{--                                <span class="font-extrabold">--}}
                        {{--                  This document is computer-generated test report & does not require any signatures or stamp. Verification can be done by scanning the provided QR Code.--}}
                        {{--                            @if($testReport->phase_id == 1)--}}
                        {{--                                        This report will be considered valid after authorizing by Sub Divisional Officer.--}}
                        {{--                                    @endif--}}
                        {{--                  </span><br>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        @foreach($testReport->reviews as $rw)--}}
                        {{--                            <div class="grid grid-cols-1 gap-4">--}}
                        {{--                                @if(Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0], 'web')->name == "DEI" || Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0], 'web')->name == "AEI")--}}
                        {{--                                    <div class="mt-2 text-justify p-2" style="border: 1px solid black;font-size: 12px;">--}}
                        {{--                  <span class="font-extrabold text-sm">--}}
                        {{--                  Test Report Verified By {{ $rw->user->name }}  -----}}
                        {{--                  Designation:  {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }} -----}}
                        {{--                  Sub Division: {{ $rw->divisionSubDivision->sub_division_name }}--}}
                        {{--                  </span>--}}
                        {{--                                        <br>--}}
                        {{--                                        <span class="font-extrabold text-sm">--}}
                        {{--                  UID: {{ $rw->user->id }}-Created-{{ $rw->created_at }}--}}
                        {{--                  </span>--}}
                        {{--                                        <br>--}}
                        {{--                                        @if($rw->status == "Objection" )--}}
                        {{--                                            <span class="font-extrabold text-sm">--}}
                        {{--                  Details: {{ $rw->remarks }}--}}
                        {{--                  </span>--}}
                        {{--                                        @else--}}
                        {{--                                            <span class="font-extrabold text-sm">--}}
                        {{--                  I have conducted a site visit and reviewed the corresponding test report. Based on load, consumer submitted a fee of--}}
                        {{--                  Rs.{{ $rw->testReport->challan->amount }} via Challan No: {{ $rw->testReport->challan_id }} ,  Dated: {{ \Carbon\Carbon::parse($rw->testReport->challan->date)->format('d-M-Y') }}. Based on my assessment, I recommend granting a No Objection Certificate (NOC) for this connection.--}}
                        {{--                  </span>--}}
                        {{--                                        @endif--}}
                        {{--                                        <div class="text-center font-extrabold  text-sm">--}}
                        {{--                                            {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }}--}}
                        {{--                                            Findings: {{ $rw->status }}--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                @else--}}
                        {{--                                    <div class="mt-2 text-justify p-2" style="border: 1px solid black;font-size: 12px;">--}}
                        {{--                  <span class="font-extrabold text-sm">--}}
                        {{--                  Test Report Verified By {{ $rw->user->name }}  -----}}
                        {{--                  Designation:  {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }} -----}}
                        {{--                  Sub Division: {{ $rw->divisionSubDivision->sub_division_name }}--}}
                        {{--                  </span>--}}
                        {{--                                        <br>--}}
                        {{--                                        <span class="font-extrabold text-sm">--}}
                        {{--                  UID: {{ $rw->user->id }}-Created-{{ $rw->created_at }}--}}
                        {{--                  </span>--}}
                        {{--                                        <br>--}}
                        {{--                                        <span class="font-extrabold text-sm">--}}
                        {{--                  Description: {{ $rw->remarks }}--}}
                        {{--                  </span>--}}
                        {{--                                        <div class="text-center font-extrabold  text-sm">--}}
                        {{--                                            {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }}--}}
                        {{--                                            Findings: {{ $rw->status }}--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                @endif--}}
                        {{--                            </div>--}}
                        {{--                        @endforeach--}}
                    </div>


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