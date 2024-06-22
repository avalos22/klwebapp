<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Kronos') }}
        </h2>
    </x-slot>
    {{-- @section('content') --}}
    <div class="py-1 md:mx-auto">
        <div class="">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
    {{-- @endsection --}}
</x-app-layout>
