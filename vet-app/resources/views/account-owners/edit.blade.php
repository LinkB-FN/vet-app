<x-layouts.app title="Editar Propietario">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Propietario</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Actualiza la información del propietario</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('account-owners.update', $accountOwner) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <flux:input 
                        label="Nombre" 
                        name="name" 
                        type="text" 
                        placeholder="Nombre completo del propietario"
                        :value="old('name', $accountOwner->name)"
                        required
                    />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Usuario de Discord" 
                        name="discord_username" 
                        type="text" 
                        placeholder="usuario#1234"
                        :value="old('discord_username', $accountOwner->discord_username)"
                    />
                    @error('discord_username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Email" 
                        name="email" 
                        type="email" 
                        placeholder="correo@ejemplo.com"
                        :value="old('email', $accountOwner->email)"
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Región" 
                        name="region"
                        placeholder="Selecciona una región"
                    >
                        <option value="">Selecciona una región</option>
                        <option value="NA-East" {{ old('region', $accountOwner->region) == 'NA-East' ? 'selected' : '' }}>NA-East</option>
                        <option value="NA-West" {{ old('region', $accountOwner->region) == 'NA-West' ? 'selected' : '' }}>NA-West</option>
                        <option value="Europe" {{ old('region', $accountOwner->region) == 'Europe' ? 'selected' : '' }}>Europe</option>
                        <option value="Asia" {{ old('region', $accountOwner->region) == 'Asia' ? 'selected' : '' }}>Asia</option>
                        <option value="Oceania" {{ old('region', $accountOwner->region) == 'Oceania' ? 'selected' : '' }}>Oceania</option>
                        <option value="Brazil" {{ old('region', $accountOwner->region) == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                        <option value="Middle East" {{ old('region', $accountOwner->region) == 'Middle East' ? 'selected' : '' }}>Middle East</option>
                    </flux:select>
                    @error('region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('account-owners.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Actualizar Propietario
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
