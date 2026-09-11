<div class="max-w-2xl mx-auto px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
    <div class="bg-surface-container-lowest shadow-sm rounded-3xl p-8 text-center border border-surface-container">
        @if($orderFolio)
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-primary-container">
                <span class="material-symbols-outlined text-[48px] text-on-primary-container">check_circle</span>
            </div>
            
            <h2 class="mt-6 font-headline-md text-headline-md text-on-surface">¡Pago procesado con éxito!</h2>
            <p class="mt-2 font-body-lg text-body-lg text-on-surface-variant">Gracias por tu compra.</p>
            
            <div class="mt-8 bg-surface-container-low rounded-2xl p-6 text-left border border-surface-container">
                <h3 class="font-title-lg text-title-lg text-on-surface mb-2">Detalles del Pedido</h3>
                <p class="font-body-md text-on-surface-variant mb-1">
                    <strong>Folio:</strong> <span class="text-primary">{{ $orderFolio }}</span>
                </p>
                <p class="font-body-sm text-on-surface-variant">
                    Hemos enviado un recibo y los detalles de tu pedido a tu correo electrónico.
                </p>
            </div>
            
            <div class="mt-8">
                <a href="{{ route('store') }}" class="inline-flex items-center justify-center h-12 px-space-xl rounded-full bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container hover:text-on-primary-container transition-all shadow-sm">
                    Volver a la tienda
                </a>
            </div>
        @else
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-error-container">
                <span class="material-symbols-outlined text-[48px] text-on-error-container">error</span>
            </div>
            
            <h2 class="mt-6 font-headline-md text-headline-md text-on-surface">Hubo un problema</h2>
            <p class="mt-2 font-body-lg text-body-lg text-on-surface-variant">No pudimos procesar o encontrar los detalles de tu pago.</p>
            
            <div class="mt-8">
                <a href="{{ route('store') }}" class="inline-flex items-center justify-center h-12 px-space-xl rounded-full bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container hover:text-on-primary-container transition-all shadow-sm">
                    Volver a la tienda
                </a>
            </div>
        @endif
    </div>
</div>
