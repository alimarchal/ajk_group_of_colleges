<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Staff / Teachers / Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4"/>
                    <form method="POST" action="{{ route('staff-information.teachers.update', $user->id) }}">
                        @csrf
                        @method('PUT')


                        <div class="mt-1 grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
                            <div>
                                <x-label for="name" value="{{ __('Name') }}"/>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name"/>
                            </div>

                            <div class="mt-0">
                                <x-label for="email" value="{{ __('Email') }}"/>
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="username"/>
                            </div>


                            <div class="mt-0">
                                <x-label for="gender" value="{{ __('Gender') }}"/>
                                <select name="gender" id="gender" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a gender</option>
                                    <option value="{{ $user->gender }}" {{ $user->gender == "Male"? 'selected' : '' }}>Male</option>
                                    <option value="{{ $user->gender }}" {{ $user->gender == "Female"? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="mt-0">
                                <x-label for="dob" value="{{ __('Date Of Birth') }}"/>
                                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="$user->dob" required/>
                            </div>


                            <div class="mt-0">
                                <x-label for="mobile" value="{{ __('Mobile') }}"/>
                                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="$user->mobile" required/>
                            </div>


                            <div class="mt-0">
                                <x-label for="phone_network_id" value="{{ __('Mobile Network') }}"/>
                                <select name="phone_network_id" id="phone_network_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a mobile network</option>
                                    @foreach(\App\Models\PhoneNetwork::all() as $pn)
                                        <option value="{{ $pn->id }}" @if($pn->id == $user->phone_network_id) selected @endif>{{ $pn->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mt-4">
                                <label for="permissions" class="block text-gray-700 text-sm font-bold mb-2">Permissions:</label>
                                @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" class="form-checkbox"
                                                {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                        <label for="permission_{{ $permission->id }}" class="ml-2">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                                @error('permissions')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="permissions" class="block text-gray-700 text-sm font-bold mb-2">Subject Teaching</label>
                                @foreach(\App\Models\Subject::all() as $sbj)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="subjects[]" id="subject_{{ $sbj->id }}" value="{{ $sbj->id }}" class="form-checkbox inline-block border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                               @if($user->teaching_subjects->contains('subject_id', $sbj->id))
                                                   checked
                                                @endif
                                        >
                                        <label for="subject_{{ $sbj->id }}" class="ml-2">{{ $sbj->name }}</label>
                                    </div>
                                @endforeach
                            </div>


                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
