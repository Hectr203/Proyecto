<div>
    <div class="text-center mb-8">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Verificar Correo Electrónico</h2>
    </div>

    <div class="mb-4 font-body-md text-body-md text-on-surface-variant">
        {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos otro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 rounded-xl bg-tertiary-container text-on-tertiary-container font-label-md text-label-md border border-tertiary-fixed-dim">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
        </div>
    @endif

    <div class="mt-8 flex flex-col space-y-4">
        <button wire:click="sendVerification" class="w-full h-11 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
            {{ __('Reenviar correo de verificación') }}
        </button>

        <button wire:click="logout" type="button" class="w-full h-11 px-space-lg rounded-full bg-surface-container text-on-surface hover:bg-surface-container-high font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center">
            {{ __('Cerrar Sesión') }}
        </button>
    </div>
</div>
