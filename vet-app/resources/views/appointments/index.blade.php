<x-layouts.app title="Citas">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Citas</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Gestiona las citas veterinarias</p>
            </div>
            <flux:button href="{{ route('appointments.create') }}" variant="primary" icon="plus">
                Nueva Cita
            </flux:button>
        </div>

        @if(session('success'))
        <flux:banner variant="success" dismissible>
            {{ session('success') }}
        </flux:banner>
        @endif

        <!-- Appointments Table -->
        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Mascota</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Dueño</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Motivo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Veterinario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $appointment->appointment_date->format('d/m/Y') }}
                                </div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ $appointment->appointment_date->format('H:i') }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <a href="{{ route('pets.show', $appointment->pet) }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                    {{ $appointment->pet->name }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                <a href="{{ route('owners.show', $appointment->pet->owner) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                    {{ $appointment->pet->owner->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $appointment->reason }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $appointment->user?->name ?? 'No asignado' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <flux:badge :color="match($appointment->status) {
                                    'confirmed' => 'green',
                                    'completed' => 'blue',
                                    'cancelled' => 'red',
                                    default => 'yellow'
                                }">
                                    {{ ucfirst($appointment->status) }}
                                </flux:badge>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button href="{{ route('appointments.show', $appointment) }}" size="sm" variant="ghost" icon="eye">Ver</flux:button>
                                    <flux:button href="{{ route('appointments.edit', $appointment) }}" size="sm" variant="ghost" icon="pencil">Editar</flux:button>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" icon="trash" class="text-red-600 hover:text-red-700">Eliminar</flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-500 dark:text-gray-400">
                                    <p class="text-lg font-medium">No hay citas registradas</p>
                                    <p class="mt-1 text-sm">Comienza creando una nueva cita</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($appointments->hasPages())
            <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
                {{ $appointments->links() }}
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
