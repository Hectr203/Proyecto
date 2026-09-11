<div class="bg-error-container p-6 rounded-3xl shadow-sm border border-error mb-6">
    <header class="mb-6">
        <h2 class="font-headline-sm text-headline-sm text-on-error-container flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-error"></span>
            {{ __('Eliminar Cuenta') }}
        </h2>
        <p class="mt-1 font-body-sm text-body-sm text-on-error-container">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato que desees conservar.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="h-11 px-6 rounded-full bg-error text-on-error hover:bg-error-container hover:text-on-error-container hover:border hover:border-error font-label-md text-label-md transition-all active:scale-95 shadow-sm"
    >
        {{ __('Eliminar Cuenta') }}
    </button>

    <x-molecules.modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit.prevent="deleteUser" class="p-6 bg-surface-container-lowest">
            <h2 class="font-headline-sm text-headline-sm text-on-surface">
                {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
            </h2>

            <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">
                {{ __('Una vez eliminada, no habrá forma de recuperarla. Por favor, ingresa tu contraseña para confirmar.') }}
            </p>

            <div class="mt-6">
                <x-atoms.input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <x-atoms.text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Contraseña') }}"
                />

                <x-atoms.input-error :messages="$errors->get('password')" class="mt-2 text-error" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="h-11 px-6 rounded-full bg-surface-container text-on-surface hover:bg-surface-container-high font-label-md text-label-md transition-all active:scale-95">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="h-11 px-6 rounded-full bg-error text-on-error hover:bg-error-container hover:text-on-error-container hover:border hover:border-error font-label-md text-label-md transition-all active:scale-95 shadow-sm">
                    {{ __('Eliminar Cuenta') }}
                </button>
            </div>
        </form>
    </x-molecules.modal>
</div>
