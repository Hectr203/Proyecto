<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-surface">
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden sm:rounded-2xl border border-surface-container">
        
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-on-surface">Verifica tu cuenta</h2>
            <p class="mt-2 text-sm text-on-surface-variant">Hemos enviado un código de 6 dígitos a tu correo electrónico. Por favor, ingrésalo a continuación.</p>
        </div>

        <form wire:submit="verify">
            <!-- OTP Code -->
            <div>
                <label for="code" class="block font-medium text-sm text-on-surface">Código de Verificación</label>
                <input wire:model="code" id="code" class="block mt-1 w-full rounded-xl border-surface-container shadow-sm focus:border-primary focus:ring focus:ring-primary/20 bg-surface-container-lowest text-center text-2xl tracking-[0.5em] py-3" type="text" name="code" required autofocus maxlength="6" autocomplete="one-time-code" placeholder="000000" />
                @error('code')
                    <p class="text-error text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-8">
                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-primary border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary/90 focus:bg-primary/90 active:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                    Verificar y Entrar
                </button>
            </div>
        </form>

        @if ($status === 'verification-code-sent')
            <div class="mt-4 rounded-xl border border-tertiary-fixed-dim bg-tertiary-container p-4 text-sm text-on-tertiary-container" role="status">
                Te enviamos un nuevo código de verificación. Revisa tu bandeja de entrada y la carpeta de spam.
            </div>
        @endif

        <div class="mt-6 text-center text-sm text-on-surface-variant">
            <p>¿No recibiste el código o ya expiró?</p>
            <button
                type="button"
                wire:click="resendCode"
                wire:loading.attr="disabled"
                wire:target="resendCode"
                class="mt-2 font-semibold text-primary underline hover:text-primary-container disabled:cursor-wait disabled:opacity-60"
            >
                <span wire:loading.remove wire:target="resendCode">Reenviar código de verificación</span>
                <span wire:loading wire:target="resendCode">Enviando código...</span>
            </button>
        </div>
    </div>
</div>
