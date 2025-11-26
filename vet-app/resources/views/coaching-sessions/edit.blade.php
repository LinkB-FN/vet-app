<x-layouts.app title="Editar Sesión de Coaching">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Sesión de Coaching</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Actualiza la información de la sesión</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('coaching-sessions.update', $coachingSession) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <flux:select 
                        label="Cuenta de Fortnite" 
                        name="fortnite_account_id"
                        required
                    >
                        <option value="">Selecciona una cuenta</option>
                        @foreach($fortniteAccounts as $account)
                            <option value="{{ $account->id }}" {{ old('fortnite_account_id', $coachingSession->fortnite_account_id) == $account->id ? 'selected' : '' }}>
                                {{ $account->epic_username }} ({{ $account->accountOwner->name }})
                            </option>
                        @endforeach
                    </flux:select>
                    @error('fortnite_account_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Coach" 
                        name="coach_id"
                    >
                        <option value="">Sin asignar</option>
                        @foreach($coaches as $coach)
                            <option value="{{ $coach->id }}" {{ old('coach_id', $coachingSession->coach_id) == $coach->id ? 'selected' : '' }}>
                                {{ $coach->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @error('coach_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Fecha y Hora de la Sesión" 
                        name="session_date" 
                        type="datetime-local" 
                        :value="old('session_date', $coachingSession->session_date->format('Y-m-d\TH:i'))"
                        required
                    />
                    @error('session_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Tipo de Sesión" 
                        name="session_type"
                        required
                    >
                        <option value="">Selecciona un tipo</option>
                        <option value="Build Training" {{ old('session_type', $coachingSession->session_type) == 'Build Training' ? 'selected' : '' }}>Build Training</option>
                        <option value="Edit Course" {{ old('session_type', $coachingSession->session_type) == 'Edit Course' ? 'selected' : '' }}>Edit Course</option>
                        <option value="Box Fights" {{ old('session_type', $coachingSession->session_type) == 'Box Fights' ? 'selected' : '' }}>Box Fights</option>
                        <option value="Zone Wars" {{ old('session_type', $coachingSession->session_type) == 'Zone Wars' ? 'selected' : '' }}>Zone Wars</option>
                        <option value="1v1 Practice" {{ old('session_type', $coachingSession->session_type) == '1v1 Practice' ? 'selected' : '' }}>1v1 Practice</option>
                        <option value="VOD Review" {{ old('session_type', $coachingSession->session_type) == 'VOD Review' ? 'selected' : '' }}>VOD Review</option>
                        <option value="Strategy Session" {{ old('session_type', $coachingSession->session_type) == 'Strategy Session' ? 'selected' : '' }}>Strategy Session</option>
                        <option value="Aim Training" {{ old('session_type', $coachingSession->session_type) == 'Aim Training' ? 'selected' : '' }}>Aim Training</option>
                        <option value="Game Sense" {{ old('session_type', $coachingSession->session_type) == 'Game Sense' ? 'selected' : '' }}>Game Sense</option>
                        <option value="Tournament Prep" {{ old('session_type', $coachingSession->session_type) == 'Tournament Prep' ? 'selected' : '' }}>Tournament Prep</option>
                        <option value="Creative Practice" {{ old('session_type', $coachingSession->session_type) == 'Creative Practice' ? 'selected' : '' }}>Creative Practice</option>
                        <option value="Piece Control" {{ old('session_type', $coachingSession->session_type) == 'Piece Control' ? 'selected' : '' }}>Piece Control</option>
                    </flux:select>
                    @error('session_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Estado" 
                        name="status"
                        required
                    >
                        <option value="pending" {{ old('status', $coachingSession->status) == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmed" {{ old('status', $coachingSession->status) == 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                        <option value="completed" {{ old('status', $coachingSession->status) == 'completed' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelled" {{ old('status', $coachingSession->status) == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                    </flux:select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:textarea 
                        label="Notas" 
                        name="notes" 
                        placeholder="Objetivos de la sesión, áreas a trabajar, etc."
                        rows="4"
                    >{{ old('notes', $coachingSession->notes) }}</flux:textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('coaching-sessions.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Actualizar Sesión
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
