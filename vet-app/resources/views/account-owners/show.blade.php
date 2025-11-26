<x-layouts.app title="Detalles del Propietario">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $accountOwner->name }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Información del propietario</p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('account-owners.edit', $accountOwner) }}" variant="primary" icon="pencil">
                    Editar
                </flux:button>
                <flux:button href="{{ route('account-owners.index') }}" variant="ghost">
                    Volver
                </flux:button>
            </div>
        </div>

        <!-- Account Owner Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de Contacto</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Usuario de Discord</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $accountOwner->discord_username ?? 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $accountOwner->email ?? 'No especificado' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Región</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $accountOwner->region ?? 'No especificada' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Fortnite Accounts List -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Cuentas de Fortnite ({{ $accountOwner->fortniteAccounts->count() }})</h2>
                <flux:button href="{{ route('fortnite-accounts.create', ['account_owner_id' => $accountOwner->id]) }}" size="sm" variant="primary" icon="plus">
                    Agregar Cuenta
                </flux:button>
            </div>

            @if($accountOwner->fortniteAccounts->count() > 0)
            <div class="mt-4 space-y-3">
                @foreach($accountOwner->fortniteAccounts as $account)
                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $account->epic_username }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $account->platform }} - {{ $account->rank ?? 'Sin rango' }}
                            @if($account->account_created_date)
                                · Cuenta creada: {{ $account->account_created_date->format('d/m/Y') }}
                            @endif
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                            {{ $account->coachingSessions->count() }} sesiones registradas
                        </div>
                    </div>
                    <flux:button href="{{ route('fortnite-accounts.show', $account) }}" size="sm" variant="ghost" icon="eye">
                        Ver
                    </flux:button>
                </div>
                @endforeach
            </div>
            @else
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">Este propietario no tiene cuentas de Fortnite registradas.</p>
            @endif
        </div>
    </div>
</x-layouts.app>
