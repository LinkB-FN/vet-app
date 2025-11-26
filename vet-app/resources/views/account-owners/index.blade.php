<x-layouts.app title="Propietarios de Cuentas">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Propietarios de Cuentas</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Gestiona los propietarios de cuentas de Fortnite</p>
            </div>
            <flux:button href="{{ route('account-owners.create') }}" variant="primary" icon="plus">
                Nuevo Propietario
            </flux:button>
        </div>

        @if(session('success'))
        <flux:banner variant="success" dismissible>
            {{ session('success') }}
        </flux:banner>
        @endif

        <!-- Account Owners Table -->
        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Discord</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Región</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Cuentas</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($accountOwners as $accountOwner)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $accountOwner->name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $accountOwner->discord_username ?? 'N/A' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $accountOwner->email ?? 'N/A' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $accountOwner->region ?? 'N/A' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $accountOwner->fortniteAccounts->count() }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button href="{{ route('account-owners.show', $accountOwner) }}" size="sm" variant="ghost" icon="eye">Ver</flux:button>
                                    <flux:button href="{{ route('account-owners.edit', $accountOwner) }}" size="sm" variant="ghost" icon="pencil">Editar</flux:button>
                                    <form action="{{ route('account-owners.destroy', $accountOwner) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este propietario?');">
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
                                    <p class="text-lg font-medium">No hay propietarios registrados</p>
                                    <p class="mt-1 text-sm">Comienza creando un nuevo propietario</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($accountOwners->hasPages())
            <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
                {{ $accountOwners->links() }}
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
