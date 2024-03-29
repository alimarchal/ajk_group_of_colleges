<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6 ">
                <a href="{{ route('instituteClass.index') }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\InstituteClass::count() }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Class Rooms
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=21140&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>


                <a href="{{ route('section.index') }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\Section::where('active',1)->count() }}
                                    </div>
                                    <div class="mt-1 text-base font-extrabold text-black">
                                        Sections
                                    </div>
                                </div>
                                <div class="col-span-1 flex items-center justify-end">
                                    <img src="https://img.icons8.com/?size=128&id=yoPTbS9GiwZh&format=png" alt="employees on leave" class="h-12 w-12">
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
        </div>
    </div>
</x-app-layout>



