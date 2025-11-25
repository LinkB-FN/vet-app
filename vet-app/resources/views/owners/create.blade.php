<x-layouts.app title="Crear Dueño">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Crear Dueño</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Registra un nuevo dueño de mascota</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('owners.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <flux:input 
                        label="Nombre" 
                        name="name" 
                        type="text" 
                        placeholder="Nombre completo del dueño"
                        :value="old('name')"
                        required
                    />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Teléfono" 
                        name="phone" 
                        type="tel" 
                        placeholder="Número de teléfono"
                        :value="old('phone')"
                    />
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Email" 
                        name="email" 
                        type="email" 
                        placeholder="correo@ejemplo.com"
                        :value="old('email')"
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:textarea 
                        label="Dirección" 
                        name="address" 
                        placeholder="Dirección completa"
                        rows="3"
                    >{{ old('address') }}</flux:textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('owners.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Crear Dueño
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
