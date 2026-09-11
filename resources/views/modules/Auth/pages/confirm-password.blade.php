<div>
    <div class="text-center mb-8">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Confirmar Contraseña</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.</p>
    </div>

    <form wire:submit="confirmPassword">
        <!-- Password -->
        <div>
            <x-atoms.input-label for="password" :value="__('Contraseña')" />

            <x-atoms.text-input wire:model="password"
                          id="password"
                          class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-atoms.input-error :messages="$errors->get('password')" class="mt-2 text-error" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full h-11 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
                {{ __('Confirmar') }}
            </button>
        </div>
    </form>
</div>
