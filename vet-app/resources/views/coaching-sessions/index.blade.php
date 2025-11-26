<x-layouts.app title="Sesiones de Coaching">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Sesiones de Coaching</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Gestiona las sesiones de coaching de Fortnite</p>
            </div>
            <flux:button href="{{ route('coaching-sessions.create') }}" variant="primary" icon="plus">
                Nueva Sesión
            </flux:button>
        </div>

        @if(session('success'))
        <flux:banner variant="success" dismissible>
            {{ session('success') }}
        </flux:banner>
        @endif

        <!-- Coaching Sessions Table -->
        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Cuenta</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Propietario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Tipo de Sesión</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Coach</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($coachingSessions as $session)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $session->fortniteAccount->epic_username }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->fortniteAccount->accountOwner->name }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->session_type }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->session_date->format('d/m/Y H:i') }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->coach?->name ?? 'Sin asignar' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <flux:badge :color="$session->status === 'completed' ? 'green' : ($session->status === 'confirmed' ? 'blue' : ($session->status === 'cancelled' ? 'red' : 'yellow'))">
                                    {{ ucfirst($session->status) }}
                                </flux:badge>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button href="{{ route('coaching-sessions.show', $session) }}" size="sm" variant="ghost" icon="eye">Ver</flux:button>
                                    <flux:button href="{{ route('coaching-sessions.edit', $session) }}" size="sm" variant="ghost" icon="pencil">Editar</flux:button>
                                    <form action="{{ route('coaching-sessions.destroy', $session) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta sesión?');">
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
                                    <p class="text-lg font-medium">No hay sesiones registradas</p>
                                    <p class="mt-1 text-sm">Comienza creando una nueva sesión de coaching</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($coachingSessions->hasPages())
            <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
                {{ $coachingSessions->links() }}
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
