<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Directory') }}
        </h2>
    </x-slot>

    <div class="ms-12 me-12 mt-6">
        <div class="flex items-center space-x-2">
            <select
                class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                <option value="all">All</option>
                <option value="station">Station</option>
                <option value="customer">Customer</option>
                <option value="supplier">Supplier</option>
            </select>
            <x-input type="text" placeholder="Who are you looking for?" wire:model="searchTerm" />
            <a href="{{ route('business-directory.customer.create') }}" class="inline-block">
                <x-button>Add Customer</x-button>
            </a>
            <x-button>Add New Station</x-button>
            <x-button>Add Supplier</x-button>
            @if (session('success'))
                <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="flex flex-wrap">
            @foreach ($entries as $entry)
                <div class="border border-gray-300 p-4 m-4 rounded-md w-full md:w-1/2 lg:w-1/2 xl:w-1/6">
                    <div class="">
                        @if ($entry->picture)
                            <img src="{{ $entry->picture }}" alt="{{ $entry->company }}" class="w-16 h-16 rounded-full">
                        @else
                            <div
                                class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center text-4xl text-white font-s">
                                {{ strtoupper(substr($entry->company, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h2>{{ $entry->company }}</h2>
                            <p>{{ $entry->city }}, {{ $entry->state }}</p>
                            <p>Days of credit {{ $entry->credit_days }}</p>
                        </div>
                    </div>
                    <p class="mb-4"><strong>Mobile:</strong> {{ $entry->phone }}</p>
                    <div>
                        <x-button>
                            <a href="{{ route('business-directory.contacts.contact-details', $entry->id) }}">Details</a>
                        </x-button>
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
