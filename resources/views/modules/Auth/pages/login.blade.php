<div>
    <div class="text-center mb-8">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">¡Bienvenido de nuevo!</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Ingresa tus credenciales para acceder a tu cuenta.</p>
    </div>

    <!-- Session Status -->
    <x-molecules.auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-atoms.input-label for="email" :value="__('Correo Electrónico')" />
            <x-atoms.text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-atoms.input-error :messages="$errors->get('form.email')" class="mt-2 text-error" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-atoms.input-label for="password" :value="__('Contraseña')" />

            <x-atoms.text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-atoms.input-error :messages="$errors->get('form.password')" class="mt-2 text-error" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-surface-container text-primary shadow-sm focus:ring-primary focus:ring-offset-surface-container-lowest" name="remember">
                <span class="ms-2 font-body-sm text-body-sm text-on-surface-variant">{{ __('Recuérdame') }}</span>
            </label>
        </div>

        <div class="flex flex-col space-y-4 mt-8">
            <button type="submit" class="w-full h-11 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
                {{ __('Iniciar Sesión') }}
            </button>
            
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>
