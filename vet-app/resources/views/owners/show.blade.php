<x-layouts.app title="Detalles del Dueño">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $owner->name }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Información del dueño</p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('owners.edit', $owner) }}" variant="primary" icon="pencil">
                    Editar
                </flux:button>
                <flux:button href="{{ route('owners.index') }}" variant="ghost">
                    Volver
                </flux:button>
            </div>
        </div>

        <!-- Owner Information -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Información de Contacto</h2>
            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $owner->phone ?? 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $owner->email ?? 'No especificado' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dirección</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $owner->address ?? 'No especificada' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Pets List -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Mascotas ({{ $owner->pets->count() }})</h2>
                <flux:button href="{{ route('pets.create', ['owner_id' => $owner->id]) }}" size="sm" variant="primary" icon="plus">
                    Agregar Mascota
                </flux:button>
            </div>

            @if($owner->pets->count() > 0)
            <div class="mt-4 space-y-3">
                @foreach($owner->pets as $pet)
                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $pet->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $pet->species }} - {{ $pet->breed ?? 'Raza no especificada' }}
                            @if($pet->birth_date)
                                · {{ $pet->birth_date->age }} años
                            @endif
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                            {{ $pet->appointments->count() }} citas registradas
                        </div>
                    </div>
                    <flux:button href="{{ route('pets.show', $pet) }}" size="sm" variant="ghost" icon="eye">
                        Ver
                    </flux:button>
                </div>
                @endforeach
            </div>
            @else
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">Este dueño no tiene mascotas registradas.</p>
            @endif
        </div>
    </div>
</x-layouts.app>
