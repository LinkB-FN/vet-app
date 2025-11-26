<x-layouts.app title="Detalles de Cuenta">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $fortniteAccount->epic_username }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Información de la cuenta de Fortnite</p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('fortnite-accounts.edit', $fortniteAccount) }}" variant="primary" icon="pencil">
                    Editar
                </flux:button>
                <flux:button href="{{ route('fortnite-accounts.index') }}" variant="ghost">
                    Volver
                </flux:button>
            </div>
        </div>

        <!-- Account Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de la Cuenta</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Propietario</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="{{ route('account-owners.show', $fortniteAccount->accountOwner) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                            {{ $fortniteAccount->accountOwner->name }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Plataforma</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $fortniteAccount->platform }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Rango</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $fortniteAccount->rank ?? 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Cuenta Creada</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ $fortniteAccount->account_created_date ? $fortniteAccount->account_created_date->format('d/m/Y') : 'No especificada' }}
                    </dd>
                </div>
                @if($fortniteAccount->notes)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notas</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $fortniteAccount->notes }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <!-- Coaching Sessions List -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Sesiones de Coaching ({{ $fortniteAccount->coachingSessions->count() }})</h2>
                <flux:button href="{{ route('coaching-sessions.create', ['fortnite_account_id' => $fortniteAccount->id]) }}" size="sm" variant="primary" icon="plus">
                    Agregar Sesión
                </flux:button>
            </div>

            @if($fortniteAccount->coachingSessions->count() > 0)
            <div class="mt-4 space-y-3">
                @foreach($fortniteAccount->coachingSessions as $session)
                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $session->session_type }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $session->session_date->format('d/m/Y H:i') }}
                            @if($session->coach)
                                · Coach: {{ $session->coach->name }}
                            @endif
                        </div>
                        <div class="mt-1 flex items-center gap-2">
                            <flux:badge :color="$session->status === 'completed' ? 'green' : ($session->status === 'confirmed' ? 'blue' : ($session->status === 'cancelled' ? 'red' : 'yellow'))">
                                {{ ucfirst($session->status) }}
                            </flux:badge>
                        </div>
                    </div>
                    <flux:button href="{{ route('coaching-sessions.show', $session) }}" size="sm" variant="ghost" icon="eye">
                        Ver
                    </flux:button>
                </div>
                @endforeach
            </div>
            @else
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">Esta cuenta no tiene sesiones de coaching registradas.</p>
            @endif
        </div>
    </div>
</x-layouts.app>
