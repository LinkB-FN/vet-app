<x-layouts.app title="Detalles de la Mascota">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pet->name }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $pet->species }} - {{ $pet->breed ?? 'Raza no especificada' }}</p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('pets.edit', $pet) }}" variant="primary" icon="pencil">
                    Editar
                </flux:button>
                <flux:button href="{{ route('pets.index') }}" variant="ghost">
                    Volver
                </flux:button>
            </div>
        </div>

        <!-- Pet Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de la Mascota</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dueño</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="{{ route('owners.show', $pet->owner) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">
                            {{ $pet->owner->name }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Especie</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pet->species }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Raza</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pet->breed ?? 'No especificada' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Nacimiento</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        @if($pet->birth_date)
                            {{ $pet->birth_date->format('d/m/Y') }} ({{ $pet->birth_date->age }} años)
                        @else
                            No especificada
                        @endif
                    </dd>
                </div>
                @if($pet->notes)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notas</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pet->notes }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <!-- Appointments List -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Historial de Citas ({{ $pet->appointments->count() }})</h2>
                <flux:button href="{{ route('appointments.create', ['pet_id' => $pet->id]) }}" size="sm" variant="primary" icon="plus">
                    Nueva Cita
                </flux:button>
            </div>

            @if($pet->appointments->count() > 0)
            <div class="mt-4 space-y-3">
                @foreach($pet->appointments->sortByDesc('appointment_date') as $appointment)
                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $appointment->reason }}</div>
                            <flux:badge :color="match($appointment->status) {
                                'confirmed' => 'green',
                                'completed' => 'blue',
                                'cancelled' => 'red',
                                default => 'yellow'
                            }">
                                {{ ucfirst($appointment->status) }}
                            </flux:badge>
                        </div>
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                            @if($appointment->user)
                                · Dr. {{ $appointment->user->name }}
                            @endif
                        </div>
                        @if($appointment->notes)
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ $appointment->notes }}
                        </div>
                        @endif
                    </div>
                    <flux:button href="{{ route('appointments.show', $appointment) }}" size="sm" variant="ghost" icon="eye">
                        Ver
                    </flux:button>
                </div>
                @endforeach
            </div>
            @else
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">Esta mascota no tiene citas registradas.</p>
            @endif
        </div>
    </div>
</x-layouts.app>
