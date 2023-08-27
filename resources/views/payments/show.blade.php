<x-app-layout>
    @push('custom_headers')
        <style>
            /* Define watermark styles for print */
            @media print {
                .heading {
                    font-family: Calibri;
                    font-size: 36px;
                    text-align: center;
                    background-color: #000;
                    color: #fff;
                }

                /* Add the "Not Verified" text on top of the page */
                /*body::before {*/
                /*    content: "[Your Application is Rejected]";*/
                /*    position: absolute;*/
                /*    bottom: 50%;*/
                /*    left: 50%;*/
                /*    transform: translate(-50%, 50%) rotate(-45deg);*/
                /*    font-size: 20px; !* Change the font size as needed *!*/
                /*    font-weight: bold;*/
                /*    color: black; !* Change the text color as needed *!*/
                /*    white-space: nowrap; !* Prevent the text from wrapping to the next line *!*/
                /*    padding: 20px; !* Optional: add some padding to the watermark *!*/
                /*    opacity: 0.9; !* Set the desired opacity (0.0 to 1.0) *!*/
                /*}*/
            }

        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Test Reports') }}
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('payment.index') }}"
               class=" text-center px-4 py-2 text-white bg-red-500 border rounded-lg focus:outline-none hover:bg-green-900 transition-colors duration-200 transform dark:text-black dark:border-red-200 dark:hover:bg-green-900 dark:bg-gray-700 ml-2"
               title="Back">
                Back
            </a>
            <button onclick="window.print()"
                    class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                    title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
            </button>
        </div>
    </x-slot>
    <div class="py-0">
        <div class="max-w-7xl mx-auto ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden content">
                <h3 class="text-xs text-left font-extrabold mt-1">
                    {{ \App\Models\Branch::find(1)->name }} - {{ \App\Models\Branch::find(1)->address }}
                    <br><span class="text-xs text-left font-extrabold underline">Student Information</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Fee Period {{ \Carbon\Carbon::parse($challan->payments->min('issue_date'))->format('M-Y') }} - {{ \Carbon\Carbon::parse($challan->payments->max('due_date'))->format('M-Y') }}
                </h3>

                <table class="w-full text-sm mt-1 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                    <tbody style="font-size: 12px;">
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white" width="30%">
                            Name
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->firstname . ' ' . $challan->student->lastname }}
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Student ID:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->id }}
                        </td>
                    </tr>

                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Class:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->instituteClass->name }} / {{ $challan->student->section->name }}
                        </td>

                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Session:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            2023-2024
                        </td>
                    </tr>



                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1  border-black font-extrabold underline text-center text-black dark:text-white" colspan="4">
                            Challan Information
                        </td>
                    </tr>
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Issue Date:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($challan->payments->min('issue_date'))->format('d-M-Y') }}
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Any UBL Bank:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            1105-222405312
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Due Date
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($challan->payments->min('due_date'))->format('d-M-Y') }}
                        </td>

                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Any HBL Bank:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            1105-222405312
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                        <td class="border px-1 border-black text-center underline font-extrabold text-black dark:text-white" colspan="2">
                            Charges
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            Challan Number:
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            {{ $challan->id }}
                        </td>


                    </tr>



                    @foreach($challan->payments as $py)
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                                {{ $py->feeType->feeCategory->name }}
                            </td>
                            <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                                {{ number_format($py->amount,2) }}
                            </td>

                            <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white" colspan="2">
                            </td>
                        </tr>
                    @endforeach


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                            Total:
                        </td>
                        <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                            {{ number_format($challan->payments->sum('amount'),2) }}
                        </td>

                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            Payable After Due Date:
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            {{ number_format($challan->payments->sum('amount') + $challan->payments->sum('fine') ,2) }}
                        </td>
                    </tr>
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border text-xs text-center font-extrabold text-right px-1 border-black font-medium text-black dark:text-white" colspan="4">
                            Parent Copy
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border text-xs text-center font-extrabold px-1 border-black font-medium text-black dark:text-white" colspan="4">
                            Attention: School fees must only be paid at the approved banks authorized by AJKGC. No staff member is allowed to accept cash payments for fees under any circumstances.
                        </td>
                    </tr>
                    </tbody>
                </table>

                <br>
                <br>


                <h3 class="text-xs text-left font-extrabold mt-1">
                    {{ \App\Models\Branch::find(1)->name }} - {{ \App\Models\Branch::find(1)->address }}
                    <br><span class="text-xs text-left font-extrabold underline">Student Information</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Fee Period {{ \Carbon\Carbon::parse($challan->payments->min('issue_date'))->format('M-Y') }} - {{ \Carbon\Carbon::parse($challan->payments->max('due_date'))->format('M-Y') }}
                </h3>

                <table class="w-full text-sm mt-1 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                    <tbody style="font-size: 12px;">
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white" width="30%">
                            Name
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->firstname . ' ' . $challan->student->lastname }}
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Student ID:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->id }}
                        </td>
                    </tr>

                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Class:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->instituteClass->name }} / {{ $challan->student->section->name }}
                        </td>

                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Session:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            2023-2024
                        </td>
                    </tr>



                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1  border-black font-extrabold underline text-center text-black dark:text-white" colspan="4">
                            Challan Information
                        </td>
                    </tr>
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Issue Date:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($challan->payments->min('issue_date'))->format('d-M-Y') }}
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Any UBL Bank:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            1105-222405312
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Due Date
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($challan->payments->min('due_date'))->format('d-M-Y') }}
                        </td>

                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Any HBL Bank:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            1105-222405312
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                        <td class="border px-1 border-black text-center underline font-extrabold text-black dark:text-white" colspan="2">
                            Charges
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            Challan Number:
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            {{ $challan->id }}
                        </td>


                    </tr>



                    @foreach($challan->payments as $py)
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                                {{ $py->feeType->feeCategory->name }}
                            </td>
                            <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                                {{ number_format($py->amount,2) }}
                            </td>

                            <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white" colspan="2">
                            </td>
                        </tr>
                    @endforeach


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                            Total:
                        </td>
                        <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                            {{ number_format($challan->payments->sum('amount'),2) }}
                        </td>

                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            Payable After Due Date:
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            {{ number_format($challan->payments->sum('amount') + $challan->payments->sum('fine') ,2) }}
                        </td>
                    </tr>
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border text-xs text-center font-extrabold text-right px-1 border-black font-medium text-black dark:text-white" colspan="4">
                            Parent Copy
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border text-xs text-center font-extrabold px-1 border-black font-medium text-black dark:text-white" colspan="4">
                            Attention: School fees must only be paid at the approved banks authorized by AJKGC. No staff member is allowed to accept cash payments for fees under any circumstances.
                        </td>
                    </tr>
                    </tbody>
                </table>


                <br>
                <br>

                <h3 class="text-xs text-left font-extrabold mt-1">
                    {{ \App\Models\Branch::find(1)->name }} - {{ \App\Models\Branch::find(1)->address }}
                    <br><span class="text-xs text-left font-extrabold underline">Student Information</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Fee Period {{ \Carbon\Carbon::parse($challan->payments->min('issue_date'))->format('M-Y') }} - {{ \Carbon\Carbon::parse($challan->payments->max('due_date'))->format('M-Y') }}
                </h3>

                <table class="w-full text-sm mt-1 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                    <tbody style="font-size: 12px;">
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white" width="30%">
                            Name
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->firstname . ' ' . $challan->student->lastname }}
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Student ID:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->id }}
                        </td>
                    </tr>

                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Class:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ $challan->student->instituteClass->name }} / {{ $challan->student->section->name }}
                        </td>

                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Session:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            2023-2024
                        </td>
                    </tr>



                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1  border-black font-extrabold underline text-center text-black dark:text-white" colspan="4">
                            Challan Information
                        </td>
                    </tr>
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Issue Date:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($challan->payments->min('issue_date'))->format('d-M-Y') }}
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Any UBL Bank:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            1105-222405312
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Due Date
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($challan->payments->min('due_date'))->format('d-M-Y') }}
                        </td>

                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            Any HBL Bank:
                        </td>
                        <td class="border px-1 border-black font-medium text-black dark:text-white">
                            1105-222405312
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                        <td class="border px-1 border-black text-center underline font-extrabold text-black dark:text-white" colspan="2">
                            Charges
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            Challan Number:
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            {{ $challan->id }}
                        </td>


                    </tr>



                    @foreach($challan->payments as $py)
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                                {{ $py->feeType->feeCategory->name }}
                            </td>
                            <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                                {{ number_format($py->amount,2) }}
                            </td>

                            <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white" colspan="2">
                            </td>
                        </tr>
                    @endforeach


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                            Total:
                        </td>
                        <td class="border px-1 border-black text-right font-extrabold text-left text-black dark:text-white">
                            {{ number_format($challan->payments->sum('amount'),2) }}
                        </td>

                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            Payable After Due Date:
                        </td>
                        <td class="border px-1 border-black font-extrabold text-left text-black dark:text-white">
                            {{ number_format($challan->payments->sum('amount') + $challan->payments->sum('fine') ,2) }}
                        </td>
                    </tr>
                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border text-xs text-center font-extrabold text-right px-1 border-black font-medium text-black dark:text-white" colspan="4">
                            Parent Copy
                        </td>
                    </tr>


                    <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                        <td class="border text-xs text-center font-extrabold px-1 border-black font-medium text-black dark:text-white" colspan="4">
                            Attention: School fees must only be paid at the approved banks authorized by AJKGC. No staff member is allowed to accept cash payments for fees under any circumstances.
                        </td>
                    </tr>
                    </tbody>
                </table>



            </div>
        </div>
    </div>
    @push('modals')
        <script>
            // // Execute this code on page load
            // document.addEventListener("DOMContentLoaded", function () {
            //     // Store the current window height before opening the print dialog
            //     const initialHeight = window.innerHeight;
            //
            //     // Show the print dialog when the page loads
            //     window.print();
            //
            //     // Wait for a short period (e.g., 1 second) and then check the window height again
            //     setTimeout(function () {
            //         const currentHeight = window.innerHeight;
            //
            //         // If the window height decreased, it indicates that the print dialog is open
            //         // If the window height remains the same, it means the user pressed "Cancel"
            //         if (currentHeight === initialHeight) {
            //             // Go back to the previous page
            //             window.history.back();
            //         }
            //     }, 1000); // Adjust the delay time as needed
            // });
            //
            // // Define the redirectToLink function
            // function redirectToLink(url) {
            //     window.location.href = url;
            // }
        </script>
    @endpush
</x-app-layout>
