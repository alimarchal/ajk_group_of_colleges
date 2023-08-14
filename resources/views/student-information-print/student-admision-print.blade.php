<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block"> {{ __('Student Admission') }} </h2>
        <div class="flex justify-center items-center float-right"> <a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 text-white bg-red-900 border rounded-lg focus:outline-none hover:bg-green-950 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2"> Back </a> </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden ">
                <x-student-tabs :student="$student" />
                <div class="px-6 mb-4 lg:px-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4 mt-4" />
                    <x-status-message class="mb-4" />

                    <div class="bg-white dark:bg-gray-800 overflow-hidden content">
                        <div class="grid grid-cols-3 gap-4">
                            <div></div>
                            <!-- Empty column for spacing -->
                            <div class="flex items-center justify-center">
                                <img src="{{ Storage::url('logo.png') }}" alt="Logo" class="h-16 mx-auto">
                            </div>
                            <div class="text-right mx-auto">
                                @php $test_report_data = "http://127.0.0.1:8000/testReport/" . $student->id; @endphp
                                {!! DNS2D::getBarcodeSVG($test_report_data, 'QRCODE',3,3) !!}
                            </div>
                        </div>
                        {{--                <img src="{{ Storage::url('logo.png') }}" alt="Logo Government" class="h-16 mx-auto">--}}
                        <h3 class="text-lg text-center font-extrabold">
                            Azad Jammu & Kashmir Group of Colleges
                        </h3>
                        <h1 class="text-lg text-center font-extrabold">Student Information</h1>

{{--                        @if($testReport->phase_id == 2 && $testReport->noc_issued == 1 && $testReport->status == "Approved")--}}
{{--                            <h2 class="text-lg text-center font-extrabold">--}}
{{--                                No Objection Certificate (NOC)--}}
{{--                            </h2>--}}
{{--                        @else--}}
{{--                            <h2 class="text-lg text-center font-extrabold">{{ ucwords(strtolower('WIRING TEST REPORT')) }}--}}
{{--                                ({{ $testReport->phase->name }}) - {{ $testReport->phase_type->type }}</h2>--}}
{{--                        @endif--}}


                        <table class="w-full text-sm mt-2 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                            <tbody style="font-size: 12px;">
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                    Student ID
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                    {{ $student->id }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                    Admission Number
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                    {{ $student->admission_no }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Roll Number
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->roll_no }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Class
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->instituteClass->name }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Section
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->section->name }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Category
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->category->name }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    First Name
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->firstname }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Last Name
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->lastname }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Gender
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->gender }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Date of Birth
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ \Carbon\Carbon::parse($student->dob)->format('d-M-Y') }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Religion
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->religion }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Cast
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->cast }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Mobile Number
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->mobile_no }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Email
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->email }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Admission Date
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ \Carbon\Carbon::parse($student->admission_date)->format('d-M-Y') }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Blood Group
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->bloodGroup->name }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    House
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->house }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Height
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->height }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Weight
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->weight }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Measurement Date
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ \Carbon\Carbon::parse($student->measure_date)->format('d-M-Y') }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Fees Discount
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->fees_discount }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    Medical History
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $student->medical_history }}
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        @if(!empty($student->guardian))
                            <h2 class="text-lg font-extrabold mt-1 mb-1 text-center">Guardian Information</h2>

                            <table class="w-full text-sm mt-1 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                                <tbody style="font-size: 12px;">
                                <!-- Father Information -->
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" colspan="4">
                                        Father Information
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Name
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->father_name }}
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Phone
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->father_phone }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Occupation
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->father_occupation }}
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Picture
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        <!-- Display father's picture here -->
                                        @if ($student->guardian->father_pic)
                                            <img src="{{ Storage::url($student->guardian->father_pic) }}" alt="Father's Picture" class="w-24 mx-auto h-auto border-2 border-gray-400">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>

                                <!-- Mother Information -->
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" colspan="4">
                                        Mother Information
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Name
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->mother_name }}
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Phone
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->mother_phone }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Occupation
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->mother_occupation }}
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Picture
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        <!-- Display mother's picture here -->
                                        @if ($student->guardian->mother_pic)
                                            <img src="{{ Storage::url($student->guardian->mother_pic) }}" alt="Mother's Picture"  class="w-24 mx-auto h-auto border-2 border-gray-400">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>

                                <!-- Guardian Information -->
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" colspan="4">
                                        Guardian Information
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Relationship
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->guardian_relation }}
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Phone
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->guardian_phone }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Occupation
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->guardian_occupation }}
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Email
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->guardian->guardian_email }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Address
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" >
                                        {{ $student->guardian->guardian_address }}
                                    </td>

                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Guardian Picture
                                    </td>

                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        <!-- Display mother's picture here -->
                                        @if ($student->guardian->guardian_pic)
                                            <img src="{{ Storage::url($student->guardian->guardian_pic) }}" alt="Mother's Picture"  class="w-24 mx-auto h-auto border-2 border-gray-400">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        @endif


                        @if(!empty($student->emergencyContact))
                            <h2 class="text-lg font-extrabold mt-1 text-center">Emergency Contact Information</h2>

                            <table class="w-full text-sm mt-1 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                                <tbody style="font-size: 12px;">

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Home Number Emergency Contact
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->emergencyContact->home_number_emergency_contact }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Phone Network
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->emergencyContact->phoneNetwork->name ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Mobile Number for SMS Alert
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->emergencyContact->mobile_number_for_sms_alert }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        Email Address for School Report
                                    </td>
                                    <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                        {{ $student->emergencyContact->email_address_for_school_report }}
                                    </td>
                                </tr>
                                </tbody>
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
    </div> @push('modals') <script>
        // Add a script to format the CNIC input as 00000-0000000-0
        document.getElementById('cnic').addEventListener('input', function(e) {
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
    </script> @endpush
</x-app-layout>