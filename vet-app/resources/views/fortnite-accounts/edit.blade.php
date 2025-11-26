<x-layouts.app title="Editar Cuenta de Fortnite">
    <div class="mx-auto max-w-2xl space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Cuenta de Fortnite</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Actualiza la información de la cuenta</p>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <form action="{{ route('fortnite-accounts.update', $fortniteAccount) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <flux:input 
                        label="Usuario de Epic Games" 
                        name="epic_username" 
                        type="text" 
                        placeholder="NombreDeUsuario"
                        :value="old('epic_username', $fortniteAccount->epic_username)"
                        required
                    />
                    @error('epic_username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Propietario" 
                        name="account_owner_id"
                        required
                    >
                        <option value="">Selecciona un propietario</option>
                        @foreach($accountOwners as $owner)
                            <option value="{{ $owner->id }}" {{ old('account_owner_id', $fortniteAccount->account_owner_id) == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @error('account_owner_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Plataforma" 
                        name="platform"
                        required
                    >
                        <option value="">Selecciona una plataforma</option>
                        <option value="PC" {{ old('platform', $fortniteAccount->platform) == 'PC' ? 'selected' : '' }}>PC</option>
                        <option value="PlayStation" {{ old('platform', $fortniteAccount->platform) == 'PlayStation' ? 'selected' : '' }}>PlayStation</option>
                        <option value="Xbox" {{ old('platform', $fortniteAccount->platform) == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                        <option value="Nintendo Switch" {{ old('platform', $fortniteAccount->platform) == 'Nintendo Switch' ? 'selected' : '' }}>Nintendo Switch</option>
                        <option value="Mobile" {{ old('platform', $fortniteAccount->platform) == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                    </flux:select>
                    @error('platform')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select 
                        label="Rango" 
                        name="rank"
                    >
                        <option value="">Selecciona un rango</option>
                        <option value="Bronze I" {{ old('rank', $fortniteAccount->rank) == 'Bronze I' ? 'selected' : '' }}>Bronze I</option>
                        <option value="Bronze II" {{ old('rank', $fortniteAccount->rank) == 'Bronze II' ? 'selected' : '' }}>Bronze II</option>
                        <option value="Bronze III" {{ old('rank', $fortniteAccount->rank) == 'Bronze III' ? 'selected' : '' }}>Bronze III</option>
                        <option value="Silver I" {{ old('rank', $fortniteAccount->rank) == 'Silver I' ? 'selected' : '' }}>Silver I</option>
                        <option value="Silver II" {{ old('rank', $fortniteAccount->rank) == 'Silver II' ? 'selected' : '' }}>Silver II</option>
                        <option value="Silver III" {{ old('rank', $fortniteAccount->rank) == 'Silver III' ? 'selected' : '' }}>Silver III</option>
                        <option value="Gold I" {{ old('rank', $fortniteAccount->rank) == 'Gold I' ? 'selected' : '' }}>Gold I</option>
                        <option value="Gold II" {{ old('rank', $fortniteAccount->rank) == 'Gold II' ? 'selected' : '' }}>Gold II</option>
                        <option value="Gold III" {{ old('rank', $fortniteAccount->rank) == 'Gold III' ? 'selected' : '' }}>Gold III</option>
                        <option value="Platinum I" {{ old('rank', $fortniteAccount->rank) == 'Platinum I' ? 'selected' : '' }}>Platinum I</option>
                        <option value="Platinum II" {{ old('rank', $fortniteAccount->rank) == 'Platinum II' ? 'selected' : '' }}>Platinum II</option>
                        <option value="Platinum III" {{ old('rank', $fortniteAccount->rank) == 'Platinum III' ? 'selected' : '' }}>Platinum III</option>
                        <option value="Diamond I" {{ old('rank', $fortniteAccount->rank) == 'Diamond I' ? 'selected' : '' }}>Diamond I</option>
                        <option value="Diamond II" {{ old('rank', $fortniteAccount->rank) == 'Diamond II' ? 'selected' : '' }}>Diamond II</option>
                        <option value="Diamond III" {{ old('rank', $fortniteAccount->rank) == 'Diamond III' ? 'selected' : '' }}>Diamond III</option>
                        <option value="Elite" {{ old('rank', $fortniteAccount->rank) == 'Elite' ? 'selected' : '' }}>Elite</option>
                        <option value="Champion" {{ old('rank', $fortniteAccount->rank) == 'Champion' ? 'selected' : '' }}>Champion</option>
                        <option value="Unreal" {{ old('rank', $fortniteAccount->rank) == 'Unreal' ? 'selected' : '' }}>Unreal</option>
                    </flux:select>
                    @error('rank')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input 
                        label="Fecha de Creación de Cuenta" 
                        name="account_created_date" 
                        type="date" 
                        :value="old('account_created_date', $fortniteAccount->account_created_date?->format('Y-m-d'))"
                    />
                    @error('account_created_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:textarea 
                        label="Notas" 
                        name="notes" 
                        placeholder="Objetivos, nivel actual, etc."
                        rows="3"
                    >{{ old('notes', $fortniteAccount->notes) }}</flux:textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button href="{{ route('fortnite-accounts.index') }}" variant="ghost">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Actualizar Cuenta
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
