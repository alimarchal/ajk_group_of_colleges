<x-app-layout>
    @push('custom_headers')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6 ">
                <a href="{{ route('student.index',['filter[latestStatus.name]=Approved']) }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $totalApprovedStudents }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Total Student
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=68661&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('student.index',['filter[latestStatus.name]=In-Process']) }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $inProcessStudentCount }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Admission In Process
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=VbE_YhgxwxJU&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('student.index',['filter[latestStatus.name]=Leaved']) }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $leavedStudentCount }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Migrated
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=Lr6QnNh50riM&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('student.index',['filter[latestStatus.name]=Rusticated']) }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $rusticatedStudentCount }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Rusticated
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=O6FAupk5yH5m&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-6 gap-6 mt-6">
                <div class="col-span-6 md:col-span-6 lg:col-span-3">
{{--                    style="min-height: 133.2px;"--}}
                    <div class="bg-white rounded-lg shadow-lg p-4" id="chart" >

                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('modals')
        <script>


            var options = {
                series: [@foreach($approvedStudentsByClass as $key => $value) {{ $value }}, @endforeach],
                chart: {
                    width: '100%',
                    type: 'pie',
                },
                labels: [@foreach($approvedStudentsByClass as $key => $value) '{{ $key }} - {{ $value }}', @endforeach],
                title: {
                    text: 'Admitted Students By Class',
                    align: 'center',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize:  '14px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#263238'
                    },
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        </script>
    @endpush
</x-app-layout>
