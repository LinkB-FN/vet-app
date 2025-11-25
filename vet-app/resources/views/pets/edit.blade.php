<x-layouts.app title="Editar Mascota">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Mascota</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Actualiza la información de la mascota</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('pets.update', $pet) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <flux:input 
                        label="Nombre" 
                        name="name" 
                        type="text" 
                        placeholder="Nombre de la mascota"
                        :value="old('name', $pet->name)"
                        required
                    />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select label="Dueño" name="owner_id" required>
                        <option value="">Selecciona un dueño</option>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ old('owner_id', $pet->owner_id) == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @error('owner_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <flux:input 
                            label="Especie" 
                            name="species" 
                            type="text" 
                            placeholder="Ej: Perro, Gato"
                            :value="old('species', $pet->species)"
                            required
                        />
                        @error('species')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <flux:input 
                            label="Raza" 
                            name="breed" 
                            type="text" 
                            placeholder="Raza de la mascota"
                            :value="old('breed', $pet->breed)"
                        />
                        @error('breed')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <flux:input 
                        label="Fecha de Nacimiento" 
                        name="birth_date" 
                        type="date" 
                        :value="old('birth_date', $pet->birth_date?->format('Y-m-d'))"
                    />
                    @error('birth_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:textarea 
                        label="Notas" 
                        name="notes" 
                        placeholder="Información adicional sobre la mascota"
                        rows="3"
                    >{{ old('notes', $pet->notes) }}</flux:textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('pets.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Actualizar Mascota
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
