<x-layouts.app title="Detalles de la Cita">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Cita - {{ $appointment->reason }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('appointments.edit', $appointment) }}" variant="primary" icon="pencil">
                    Editar
                </flux:button>
                <flux:button href="{{ route('appointments.index') }}" variant="ghost">
                    Volver
                </flux:button>
            </div>
        </div>

        <!-- Status Badge -->
        <div>
            <flux:badge :color="match($appointment->status) {
                'confirmed' => 'green',
                'completed' => 'blue',
                'cancelled' => 'red',
                default => 'yellow'
            }" size="lg">
                Estado: {{ ucfirst($appointment->status) }}
            </flux:badge>
        </div>

        <!-- Appointment Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de la Cita</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Mascota</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="{{ route('pets.show', $appointment->pet) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">
                            {{ $appointment->pet->name }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dueño</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="{{ route('owners.show', $appointment->pet->owner) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">
                            {{ $appointment->pet->owner->name }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Veterinario</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ $appointment->user?->name ?? 'No asignado' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha y Hora</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motivo</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $appointment->reason }}</dd>
                </div>
                @if($appointment->notes)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notas</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $appointment->notes }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <!-- Pet Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de la Mascota</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Especie</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $appointment->pet->species }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Raza</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $appointment->pet->breed ?? 'No especificada' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Edad</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        @if($appointment->pet->birth_date)
                            {{ $appointment->pet->birth_date->age }} años
                        @else
                            No especificada
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Contact Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de Contacto</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $appointment->pet->owner->phone ?? 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $appointment->pet->owner->email ?? 'No especificado' }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-layouts.app>
