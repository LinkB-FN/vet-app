<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Welcome Section -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Bienvenido, {{ auth()->user()->name }}
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Rol: <span class="font-semibold capitalize">{{ auth()->user()->role }}</span>
            </p>
        </div>

        @php
            $stats = [];
            if (auth()->user()->hasAnyRole(['admin', 'staff'])) {
                $stats = [
                    ['label' => 'Dueños', 'value' => \App\Models\Owner::count(), 'route' => 'owners.index'],
                    ['label' => 'Mascotas', 'value' => \App\Models\Pet::count(), 'route' => 'pets.index'],
                    ['label' => 'Citas', 'value' => \App\Models\Appointment::count(), 'route' => 'appointments.index'],
                ];
                if (auth()->user()->hasRole('admin')) {
                    $stats[] = ['label' => 'Usuarios', 'value' => \App\Models\User::count(), 'route' => 'admin.users.index'];
                }
            }
        @endphp

        @if(count($stats) > 0)
        <!-- Statistics Cards -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            @foreach($stats as $stat)
            <a href="{{ route($stat['route']) }}" class="block rounded-xl border border-neutral-200 bg-white p-6 transition hover:shadow-lg dark:border-neutral-700 dark:bg-neutral-800">
                <div class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $stat['label'] }}</div>
                <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</div>
            </a>
            @endforeach
        </div>
        @endif

        <!-- Quick Actions -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Acciones Rápidas</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @if(auth()->user()->hasRole('admin'))
                <flux:button href="{{ route('admin.users.create') }}" variant="primary">
                    Crear Usuario
                </flux:button>
                @endif
                
                @if(auth()->user()->hasAnyRole(['admin', 'staff']))
                <flux:button href="{{ route('owners.create') }}" variant="primary">
                    Registrar Dueño
                </flux:button>
                <flux:button href="{{ route('pets.create') }}" variant="primary">
                    Registrar Mascota
                </flux:button>
                <flux:button href="{{ route('appointments.create') }}" variant="primary">
                    Crear Cita
                </flux:button>
                @endif
            </div>
        </div>

        @if(auth()->user()->hasAnyRole(['admin', 'staff']))
        <!-- Recent Appointments -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Próximas Citas</h2>
            @php
                $upcomingAppointments = \App\Models\Appointment::with('pet.owner', 'user')
                    ->where('appointment_date', '>=', now())
                    ->where('status', '!=', 'cancelled')
                    ->orderBy('appointment_date')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($upcomingAppointments->count() > 0)
            <div class="mt-4 space-y-3">
                @foreach($upcomingAppointments as $appointment)
                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">
                            {{ $appointment->pet->name }} - {{ $appointment->pet->owner->name }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $appointment->appointment_date->format('d/m/Y H:i') }} - {{ $appointment->reason }}
                        </div>
                    </div>
                    <flux:badge :color="$appointment->status === 'confirmed' ? 'green' : 'yellow'">
                        {{ ucfirst($appointment->status) }}
                    </flux:badge>
                </div>
                @endforeach
            </div>
            @else
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">No hay citas próximas.</p>
            @endif
        </div>
        @endif
    </div>
</x-layouts.app>
