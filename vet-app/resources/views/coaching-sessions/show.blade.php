<x-layouts.app title="Detalles de Sesión">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Sesión de {{ $coachingSession->session_type }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Detalles de la sesión de coaching</p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('coaching-sessions.edit', $coachingSession) }}" variant="primary" icon="pencil">
                    Editar
                </flux:button>
                <flux:button href="{{ route('coaching-sessions.index') }}" variant="ghost">
                    Volver
                </flux:button>
            </div>
        </div>

        <!-- Session Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="flex items-start justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de la Sesión</h2>
                <flux:badge :color="$coachingSession->status === 'completed' ? 'green' : ($coachingSession->status === 'confirmed' ? 'blue' : ($coachingSession->status === 'cancelled' ? 'red' : 'yellow'))">
                    {{ ucfirst($coachingSession->status) }}
                </flux:badge>
            </div>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Cuenta de Fortnite</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="{{ route('fortnite-accounts.show', $coachingSession->fortniteAccount) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                            {{ $coachingSession->fortniteAccount->epic_username }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Propietario</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="{{ route('account-owners.show', $coachingSession->fortniteAccount->accountOwner) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                            {{ $coachingSession->fortniteAccount->accountOwner->name }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Sesión</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->session_type }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha y Hora</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->session_date->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Coach Asignado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->coach?->name ?? 'Sin asignar' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Plataforma</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->fortniteAccount->platform }}</dd>
                </div>
                @if($coachingSession->notes)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notas de la Sesión</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->notes }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <!-- Account Details -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Detalles de la Cuenta</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Rango Actual</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->fortniteAccount->rank ?? 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Región</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->fortniteAccount->accountOwner->region ?? 'No especificada' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Discord</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->fortniteAccount->accountOwner->discord_username ?? 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Sesiones</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->fortniteAccount->coachingSessions->count() }}</dd>
                </div>
            </dl>
        </div>

        <!-- Session Timeline -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información Adicional</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Creada</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Última Actualización</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $coachingSession->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-layouts.app>
