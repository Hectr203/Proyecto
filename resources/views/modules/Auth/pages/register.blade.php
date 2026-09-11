<div>
    <div class="text-center mb-8">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Crea tu cuenta</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Únete para gestionar tus pedidos y más.</p>
    </div>

    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-atoms.input-label for="name" :value="__('Nombre')" />
            <x-atoms.text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-atoms.input-error :messages="$errors->get('name')" class="mt-2 text-error" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-atoms.input-label for="email" :value="__('Correo Electrónico')" />
            <x-atoms.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-atoms.input-error :messages="$errors->get('email')" class="mt-2 text-error" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-atoms.input-label for="password" :value="__('Contraseña')" />

            <x-atoms.text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

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

        <div class="flex flex-col space-y-4 mt-8">
            <button type="submit" class="w-full h-11 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
                {{ __('Crear cuenta') }}
            </button>
            
            <div class="text-center mt-2">
                <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ route('login') }}" wire:navigate>
                    {{ __('¿Ya tienes cuenta? Inicia sesión') }}
                </a>
            </div>
        </div>
    </form>
</div>
