<x-layouts.app title="Crear Usuario">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Crear Usuario</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Registra un nuevo usuario en el sistema</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <flux:input 
                        label="Nombre" 
                        name="name" 
                        type="text" 
                        placeholder="Nombre completo"
                        :value="old('name')"
                        required
                    />
                    @error('name')
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
                        required
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select label="Rol" name="role" required>
                        <option value="">Selecciona un rol</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                    </flux:select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Contraseña" 
                        name="password" 
                        type="password" 
                        placeholder="Mínimo 8 caracteres"
                        required
                    />
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Confirmar Contraseña" 
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Repite la contraseña"
                        required
                    />
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('admin.users.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Crear Usuario
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
