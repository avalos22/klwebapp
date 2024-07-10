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
                            <x-input id="name" placeholder="Name" type="text" class="mt-1 block w-full" wire:model="name"
                                required />
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-input id="last_name" placeholder="Last Name" type="text" class="mt-1 block w-full" wire:model="last_name"
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
                            <x-input id="job_title" placeholder="Job Title" type="text" class="mt-1 block w-full" wire:model="job_title"
                                required />
                            @error('job_title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="office" value="{{ __('Office') }}" />
                            <x-input id="office" placeholder="Office" type="text" class="mt-1 block w-full" wire:model="office"
                                required />
                            @error('office')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="birthday" value="{{ __('Birthday') }}" />
                            <x-input id="birthday" placeholder="Birthday" type="date" class="mt-1 block w-full" wire:model="birthday"
                                required />
                            @error('birthday')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/4 p-1">
                            <x-label for="date_of_hire" value="{{ __('Date of Hire') }}" />
                            <x-input id="date_of_hire" placeholder="Date of hire" type="date" class="mt-1 block w-full"
                                wire:model="date_of_hire" required />
                            @error('date_of_hire')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="user_name" value="{{ __('User Name') }}" />
                            <x-input id="user_name" placeholder="User Name" type="text" class="mt-1 block w-full" wire:model="user_name"
                                required />
                            @error('user_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" placeholder="Password" type="password" class="mt-1 block w-full" wire:model="password"
                                required />
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 p-1">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" placeholder="Email" type="email" class="mt-1 block w-full" wire:model="email"
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
            @livewire('users-list')
        </div>
    </div>
</x-app-layout>
