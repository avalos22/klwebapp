<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Directory') }}
        </h2>
    </x-slot>

    <div class="ms-8 me-12 mt-6">
        <div class="flex items-center space-x-2">
            <a href="{{ route('business-directory.create', ['type' => 'customer']) }}" class="inline-block">
                <x-button>Add Customer</x-button>
            </a>

            <a href="{{ route('business-directory.create', ['type' => 'station']) }}" class="inline-block">
                <x-button>Add New Station</x-button>
            </a>

            <a href="{{ route('business-directory.create', ['type' => 'supplier']) }}" class="inline-block">
                <x-button>Add Supplier</x-button>
            </a>
            @if (session('success'))
                <div class="bg-green-500 text-white px-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="relative mt-12 overflow-x-auto">
            @livewire('directory-list')
        </div>
    </div>
</x-app-layout>
