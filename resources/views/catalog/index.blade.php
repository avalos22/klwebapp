<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog Data') }}
        </h2>
    </x-slot>

    <div class="ms-12 me-12 mt-6">
        <x-button>New Accesorial</x-button>
        <x-button>New Handling Type</x-button>
        <x-button>New Material Type</x-button>
        <x-button>New Class</x-button>
        <x-button>New UOM</x-button>
        <x-button>Charge Type</x-button>
        <x-button>Shipment Status</x-button>
        <x-button>Urgency Type</x-button>
    </div>
</x-app-layout>