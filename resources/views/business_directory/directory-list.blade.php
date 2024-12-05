<div>
    <!-- Input de búsqueda -->
    <x-input type="text" placeholder="Search" wire:model="search" wire:keydown="refreshComponent" />

   <!-- Lista de resultados -->
   <div class="grid mt-6 grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse ($entries as $entry)
        <div class="bg-white border rounded-md p-4 flex items-center space-x-4">
            <!-- Imagen o inicial -->
            @if ($entry->picture)
                <img src="{{ asset('storage/' . $entry->picture) }}" alt="{{ $entry->company }}" class="w-12 h-12 rounded-full object-cover">
            @else
                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-gray-300 text-white text-xl font-bold">
                    {{ strtoupper(substr($entry->company, 0, 1)) }}
                </div>
            @endif

            <!-- Información del cliente -->
            <div class="flex-1">
                <h3 class="text-lg font-semibold">{{ $entry->company }}</h3>
                <p class="text-sm text-red-500">{{ $entry->type }}</p>
                <p class="text-sm text-gray-500">{{ $entry->city }}, {{ $entry->state }}</p>
                <p class="text-sm text-gray-600"><strong>Mobile:</strong> {{ $entry->phone }}</p>
            </div>

            <!-- Iconos de acción -->
            <div class="flex space-x-2">
                <!-- Botón de editar -->
                <a href="{{ route('business-directory.edit', $entry->id) }}" class="text-gray-600 hover:text-blue-500">
                    <i class="fas fa-pen text-md"></i>
                </a>

                <!-- Botón de correo -->
                <a href="mailto:{{ $entry->email }}" class="text-gray-600 hover:text-green-500">
                    <i class="fas fa-envelope text-md"></i>
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No results found.</p>
    @endforelse
</div>

<!-- Paginación -->
<div class="mt-4">
    {{ $entries->links() }}
</div>
</div>
