<x-layouts.app title="Mascotas">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Mascotas</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Gestiona las mascotas registradas</p>
            </div>
            <flux:button href="{{ route('pets.create') }}" variant="primary" icon="plus">
                Nueva Mascota
            </flux:button>
        </div>

        @if(session('success'))
        <flux:banner variant="success" dismissible>
            {{ session('success') }}
        </flux:banner>
        @endif

        <!-- Pets Table -->
        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Especie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Raza</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Dueño</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Edad</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($pets as $pet)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $pet->name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $pet->species }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $pet->breed ?? 'N/A' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                <a href="{{ route('owners.show', $pet->owner) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                    {{ $pet->owner->name }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                @if($pet->birth_date)
                                    {{ $pet->birth_date->age }} años
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button href="{{ route('pets.show', $pet) }}" size="sm" variant="ghost" icon="eye">Ver</flux:button>
                                    <flux:button href="{{ route('pets.edit', $pet) }}" size="sm" variant="ghost" icon="pencil">Editar</flux:button>
                                    <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta mascota?');">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" icon="trash" class="text-red-600 hover:text-red-700">Eliminar</flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500 dark:text-gray-400">
                                    <p class="text-lg font-medium">No hay mascotas registradas</p>
                                    <p class="mt-1 text-sm">Comienza registrando una nueva mascota</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pets->hasPages())
            <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
                {{ $pets->links() }}
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
