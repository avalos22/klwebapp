<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Directory Details') }} - {{ $directory->company }}
        </h2>
    </x-slot>


    <div class="ms-12 me-12">
        <!-- Información del directorio -->
        <div class="flex flex-wrap">
            <div class="w-full flex flex-wrap mt-5">
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Nickname:</strong> {{ $directory->nickname }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Billing Currency:</strong> {{ $directory->billing_currency }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>RFC/Tax ID:</strong> {{ $directory->rfc_tax_id }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Street Address:</strong> {{ $directory->street_address }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>City:</strong> {{ $directory->city }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>State:</strong> {{ $directory->state }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Postal Code:</strong> {{ $directory->postal_code }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Phone:</strong> {{ $directory->phone }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Email:</strong> {{ $directory->email }}
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-3/12 p-1">
                    <strong>Notes:</strong> {{ $directory->notes }}
                </div>
            </div>
        </div>
{{--         
        <form action="{{ route('business-directory.contacts.store', $directory->id) }}" method="POST"
            class="space-y-6">
            @csrf

            <div class="flex flex-wrap gap-4">
                <!-- Nombre -->
                <div class="w-full md:w-1/12">
                    <x-label for="name" value="Name" />
                    <x-input id="name" name="name" placeholder="Name" class="block mt-1 w-full" required />
                </div>

                <!-- Apellido -->
                <div class="w-full md:w-1/12">
                    <x-label for="last_name" value="Last Name" />
                    <x-input id="last_name" name="last_name" placeholder="Last Name" class="block mt-1 w-full"
                        required />
                </div>

                <!-- Teléfono de oficina -->
                <div class="w-full md:w-1/12">
                    <x-label for="office_phone" value="Office Phone N." />
                    <x-input id="office_phone" name="office_phone" placeholder="Cel + Extension"
                        class="block mt-1 w-full" />
                </div>

                <!-- Teléfono móvil -->
                <div class="w-full md:w-1/12">
                    <x-label for="cellphone" value="Phone" />
                    <x-input id="cellphone" name="cellphone" placeholder="Phone" class="block mt-1 w-full" />
                </div>

                <!-- Email -->
                <div class="w-full md:w-1/6">
                    <x-label for="email" value="Email" />
                    <x-input id="email" name="email" placeholder="Email" type="email" class="block mt-1 w-full"
                        required />
                </div>

                <!-- Horas de trabajo -->
                <div class="w-full md:w-1/12">
                    <x-label for="working_hours" value="Working Hours" />
                    <x-input id="working_hours" name="working_hours" placeholder="Working Hours"
                        class="block mt-1 w-full" />
                </div>

                <!-- Notas -->
                <div class="w-full md:w-4/12">
                    <x-label for="notes" value="Notes" />
                    <textarea id="notes" name="notes" rows="1"
                        class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400"></textarea>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('business-directory.index') }}"
                    class="px-4 py-2 bg-zinc-950 text-white rounded-md shadow hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 flex items-center">
                    Cancel
                </a>
                <x-button>Add Contact</x-button>

            </div>
        </form> --}}
    </div>

    <div class="ms-12 me-12 mt-8">
        <livewire:contacts-list :directoryId="$directory->id" />
    </div>
</x-app-layout>