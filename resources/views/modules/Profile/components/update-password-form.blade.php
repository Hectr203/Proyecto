<div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm border border-surface-container mb-6">
    <header class="mb-6">
        <h2 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-secondary"></span>
            {{ __('Actualizar Contraseña') }}
        </h2>
        <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">
            {{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mantenerte seguro.') }}
        </p>
    </header>

    <form wire:submit.prevent="updatePassword" class="space-y-6">
        <div>
            <x-atoms.input-label for="update_password_current_password" :value="__('Contraseña Actual')" />
            <x-atoms.text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-atoms.input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-atoms.input-label for="update_password_password" :value="__('Nueva Contraseña')" />
            <x-atoms.text-input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-atoms.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-atoms.input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-atoms.text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-atoms.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-surface-container">
            <button type="submit" class="h-11 px-6 rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 shadow-sm">
                {{ __('Guardar') }}
            </button>

            <x-atoms.action-message class="me-3 font-label-sm text-primary" on="password-updated">
                {{ __('Guardado exitosamente.') }}
            </x-atoms.action-message>
        </div>
    </form>
</div>
