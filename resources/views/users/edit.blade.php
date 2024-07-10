<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 p-4">
                    @csrf
                    @method('PUT')
    
                    <div class="mt-4 md:col-span-6">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
                    </div>
    
                    <div class="mt-4 md:col-span-6">
                        <x-label for="last_name" :value="__('Last Name')" />
                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ $user->last_name }}" required />
                    </div>
    
                    <div class="mt-4 md:col-span-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                    </div>
    
                    <div class="mt-4 md:col-span-4">
                        <x-label for="phone" :value="__('Phone')" />
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $user->phone }}" required />
                    </div>
    
                    <div class="mt-4 md:col-span-4">
                        <x-label for="job_title" :value="__('Job Title')" />
                        <x-input id="job_title" class="block mt-1 w-full" type="text" name="job_title" value="{{ $user->job_title }}" required />
                    </div>
    
                    <div class="mt-4 md:col-span-3">
                        <x-label for="office" :value="__('Office')" />
                        <x-input id="office" class="block mt-1 w-full" type="text" name="office" value="{{ $user->office }}" required />
                    </div>
    
                    <div class="mt-4 md:col-span-3">
                        <x-label for="birthday" :value="__('Birthday')" />
                        <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" value="{{ $user->birthday->format('Y-m-d') }}" required />
                    </div>
                    
                    <div class="mt-4 md:col-span-3">
                        <x-label for="date_of_hire" :value="__('Date of Hire')" />
                        <x-input id="date_of_hire" class="block mt-1 w-full" type="date" name="date_of_hire" value="{{ $user->date_of_hire->format('Y-m-d') }}" required />
                    </div>
                    
                    <div class="mt-4 md:col-span-3">
                        <x-label for="role" :value="__('Role')" />
                        <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="md:col-span-12 mt-2 ml-auto">
                        <x-button class="w-full flex items-center justify-center">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>