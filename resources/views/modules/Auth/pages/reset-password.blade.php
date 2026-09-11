<div>
    <div class="text-center mb-8">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Restablecer Contraseña</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Ingresa tu nueva contraseña para recuperar el acceso a tu cuenta.</p>
    </div>

    <form wire:submit="resetPassword">
        <!-- Email Address -->
        <div>
            <x-atoms.input-label for="email" :value="__('Correo Electrónico')" />
            <x-atoms.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-atoms.input-error :messages="$errors->get('email')" class="mt-2 text-error" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-atoms.input-label for="password" :value="__('Nueva Contraseña')" />
            <x-atoms.text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-atoms.input-error :messages="$errors->get('password')" class="mt-2 text-error" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-atoms.input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-atoms.text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-atoms.input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-error" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full h-11 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
                {{ __('Restablecer Contraseña') }}
            </button>
        </div>
    </form>
</div>
