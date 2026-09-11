<div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm border border-surface-container mb-6">
    <header class="mb-6">
        <h2 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-primary-container"></span>
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">
            {{ __("Actualiza la información de tu cuenta y correo electrónico.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfileInformation" class="space-y-6">
        <div>
            <x-atoms.input-label for="name" :value="__('Nombre')" />
            <x-atoms.text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-atoms.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-atoms.input-label for="email" :value="__('Correo Electrónico')" />
            <x-atoms.text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-atoms.input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-xl bg-tertiary-container text-on-tertiary-container border border-tertiary-fixed-dim">
                    <p class="font-body-sm text-body-sm">
                        {{ __('Tu correo electrónico no está verificado.') }}

                        <button wire:click.prevent="sendVerification" class="underline font-label-sm text-label-sm hover:text-primary transition-colors focus:outline-none">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-label-sm text-label-sm text-primary">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-surface-container">
            <button type="submit" class="h-11 px-6 rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 shadow-sm">
                {{ __('Guardar') }}
            </button>

            <x-atoms.action-message class="me-3 font-label-sm text-primary" on="profile-updated">
                {{ __('Guardado exitosamente.') }}
            </x-atoms.action-message>
        </div>
    </form>
</div>
