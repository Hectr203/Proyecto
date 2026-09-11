<div>
    <div class="text-center mb-8">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Recuperar Contraseña</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">¿Olvidaste tu contraseña? Ingresa tu email y te enviaremos un enlace para recuperarla.</p>
    </div>

    <!-- Session Status -->
    <x-molecules.auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div>
            <x-atoms.input-label for="email" :value="__('Correo Electrónico')" />
            <x-atoms.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-atoms.input-error :messages="$errors->get('email')" class="mt-2 text-error" />
        </div>

        <div class="flex flex-col space-y-4 mt-8">
            <button type="submit" class="w-full h-11 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
                {{ __('Enviar enlace de recuperación') }}
            </button>
            <div class="text-center mt-2">
                <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ route('login') }}" wire:navigate>
                    Volver al login
                </a>
            </div>
        </div>
    </form>
</div>
