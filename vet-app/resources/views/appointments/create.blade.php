<x-layouts.app title="Crear Cita">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Crear Cita</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Programa una nueva cita veterinaria</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <flux:select label="Mascota" name="pet_id" required>
                        <option value="">Selecciona una mascota</option>
                        @foreach($pets as $pet)
                            <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                {{ $pet->name }} - {{ $pet->owner->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @error('pet_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select label="Veterinario" name="user_id">
                        <option value="">Sin asignar</option>
                        @foreach($veterinarians as $vet)
                            <option value="{{ $vet->id }}" {{ old('user_id') == $vet->id ? 'selected' : '' }}>
                                {{ $vet->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Fecha y Hora" 
                        name="appointment_date" 
                        type="datetime-local" 
                        :value="old('appointment_date')"
                        required
                    />
                    @error('appointment_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Motivo" 
                        name="reason" 
                        type="text" 
                        placeholder="Motivo de la cita"
                        :value="old('reason')"
                        required
                    />
                    @error('reason')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select label="Estado" name="status" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                    </flux:select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:textarea 
                        label="Notas" 
                        name="notes" 
                        placeholder="Notas adicionales sobre la cita"
                        rows="3"
                    >{{ old('notes') }}</flux:textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('appointments.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Crear Cita
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
