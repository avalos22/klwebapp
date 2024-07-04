<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users admin secction') }}
        </h2>
    </x-slot>

    <div class="ms-12 me-12">
        <form method="POST" action="" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap">
                <div id="user-inputs-01" class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-3/5 xl:pr-10">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                                required />
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="last_name"
                                required />
                            @error('last_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="phone" value="{{ __('Phone') }}" />
                            <x-input id="phone" placeholder="phone" type="text" class="mt-1 block w-full"
                                wire:model="phone" required />
                            @error('phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="job_title" value="{{ __('Job Title') }}" />
                            <x-input id="job_title" type="text" class="mt-1 block w-full" wire:model="job_title"
                                required />
                            @error('job_title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="office" value="{{ __('Office') }}" />
                            <x-input id="office" type="text" class="mt-1 block w-full" wire:model="office"
                                required />
                            @error('office')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="birthday" value="{{ __('Birthday') }}" />
                            <x-input id="birthday" type="date" class="mt-1 block w-full" wire:model="birthday"
                                required />
                            @error('birthday')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="date_of_hire" value="{{ __('Date of Hire') }}" />
                            <x-input id="date_of_hire" type="date" class="mt-1 block w-full"
                                wire:model="date_of_hire" required />
                            @error('date_of_hire')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="user_name" value="{{ __('User Name') }}" />
                            <x-input id="user_name" type="text" class="mt-1 block w-full" wire:model="user_name"
                                required />
                            @error('user_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="password"
                                required />
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="email"
                                required />
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div id="user-inputs-02" class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-2/5">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-3/5 p-1 xl:pr-10">
                            <div>
                                <x-label value="{{ __('Working Hours In / Out') }}" />
                                <div class="grid grid-cols-3 gap-3 pt-3">
                                    <x-input id="mon_in" type="time" wire:model="mon_in" />
                                    <x-input id="mon_out" type="time" wire:model="mon_out" />
                                    <x-label value="{{ __('Monday') }}" />
                                    <x-input id="tue_in" type="time" wire:model="tue_in" />
                                    <x-input id="tue_out" type="time" wire:model="tue_out" />
                                    <x-label value="{{ __('Tuesday') }}" />
                                    <x-input id="wed_in" type="time" wire:model="wed_in" />
                                    <x-input id="wed_out" type="time" wire:model="wed_out" />
                                    <x-label value="{{ __('Wednesday') }}" />
                                    <x-input id="thu_in" type="time" wire:model="thu_in" />
                                    <x-input id="thu_out" type="time" wire:model="thu_out" />
                                    <x-label value="{{ __('Thursday') }}" />
                                    <x-input id="fri_in" type="time" wire:model="fri_in" />
                                    <x-input id="fri_out" type="time" wire:model="fri_out" />
                                    <x-label value="{{ __('Friday') }}" />
                                    <x-input id="sat_in" type="time" wire:model="sat_in" />
                                    <x-input id="sat_out" type="time" wire:model="sat_out" />
                                    <x-label value="{{ __('Saturday') }}" />
                                    <x-input id="sun_in" type="time" wire:model="sun_in" />
                                    <x-input id="sun_out" type="time" wire:model="sun_out" />
                                    <x-label value="{{ __('Sunday') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-2/5 p-1">
                            {{-- <img src="" alt="Pic Profile">
                            <x-label value="{{ __('Add Picture') }}" />
                            <x-input type="file" class="mt-1 block w-full" wire:model="picture" />
                            @error('picture')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror --}}

                            <div x-data="{ photoName: null, photoPreview: null }" class="w-full md:w-1/2 lg:w-1/2 xl:w-2/5 p-1">
                                <input type="file" id="photo" class="hidden" wire:model="picture"
                                    x-ref="photo"
                                    x-on:change="
                                           photoName = $refs.photo.files[0].name;
                                           const reader = new FileReader();
                                           reader.onload = (e) => {
                                               photoPreview = e.target.result;
                                           };
                                           reader.readAsDataURL($refs.photo.files[0]);
                                   " />

                                <x-label for="photo" value="{{ __('Add Picture') }}" />
                            </div>
                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                {{-- <img src="" alt="Profile Photo" class=" bg-gray-600 h-56 w-56 object-cover"> --}}
                                <div class="w-56 h-56 bg-gray-600 flex items-center justify-center text-4xl text-white font-s">
                                    N/A
                                 </div>
                            </div>
                            
                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>
                            <x-secondary-button class="mt-2 me-2" type="button"
                                x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-secondary-button>

                        </div>
                    </div>
                </div>
            </div>
            <x-button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Create User') }}
            </x-button>
        </form>

        <div class="relative mt-12 overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                User ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Job Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Permissions
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pic
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Watch
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @livewire('edit-user')
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->job_title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->Permissions }}
                                </td>
                                <td class="px-6 py-4">
                                    <img src="{{ $user->profile_photo_path }}" alt="User Picture"
                                        class="w-10 h-10 rounded-full">
                                </td>
                                <td class="px-6 py-4">
                                    <!-- Botón para abrir el modal -->

                                    <div>
                                        <div><button
                                                @click="$dispatch('edit-user', { userId: {{ $user->id }} })">Edit</button>
                                        </div>
                                    </div>
                                    {{-- <a href="#" class="text-blue-600 hover:text-blue-900"
                                        wire:click.prevent="$emit('editUser', {{ $user->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a> --}}
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
