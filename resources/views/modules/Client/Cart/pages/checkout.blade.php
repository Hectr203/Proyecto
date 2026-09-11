<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    @if($paymentStatus === 'success')
        <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-2xl mx-auto border-t-4 border-green-500">
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 mb-4">¡Pago Exitoso!</h2>
            <p class="text-lg text-slate-600 mb-8">Tu pedido ha sido procesado correctamente y llegará pronto.</p>
            <a href="/" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                Volver a la tienda
            </a>
        </div>
    @elseif($paymentStatus === 'error')
        <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-2xl mx-auto border-t-4 border-red-500">
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 mb-6">
                <svg class="h-10 w-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Ocurrió un error</h2>
            <p class="text-lg text-slate-600 mb-8">El pago fue rechazado por el banco. Por favor intenta de nuevo.</p>
            <button wire:click="$set('paymentStatus', null)" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                Reintentar Pago
            </button>
        </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Formulario de Pago -->
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
            <h2 class="text-2xl font-extrabold text-slate-900 mb-8">Datos de Compra</h2>
            <form wire:submit.prevent="processPayment">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Correo Electrónico para Recibo</label>
                    <input type="email" wire:model="email" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3" placeholder="tu@correo.com">
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="flex items-center gap-3 text-slate-600 mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        <span class="font-medium">Tarjeta de Crédito / Débito</span>
                    </div>
                    <!-- Simulación Visual de Input de Tarjeta -->
                    <div class="space-y-4 text-center py-4">
                        <span class="material-symbols-outlined text-[48px] text-primary opacity-80">lock</span>
                        <p class="font-body-md text-on-surface-variant">Serás redirigido de forma segura a la pasarela de pagos de <strong>Stripe</strong> para completar tu compra.</p>
                    </div>
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none transition-transform active:scale-95">
                    Pagar y Finalizar Orden
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>

        <!-- Resumen del Pedido -->
        <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 h-fit">
            <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Resumen del Pedido</h2>
            <ul class="divide-y divide-slate-200 mb-6">
                @foreach($cart as $item)
                <li class="py-4 flex justify-between">
                    <div class="flex items-center">
                        <span class="bg-indigo-100 text-indigo-700 font-bold px-2 py-1 rounded text-xs mr-3">{{ $item['quantity'] }}x</span>
                        <span class="font-medium text-slate-800">{{ $item['nombre'] }}</span>
                    </div>
                    <span class="font-semibold text-slate-900">${{ number_format($item['precio_mxn'] * $item['quantity'], 2) }}</span>
                </li>
                @endforeach
            </ul>
            
            <div class="space-y-3 pt-4 border-t border-slate-200">
                <div class="flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotalMxn, 2) }} MXN</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>IVA (16%)</span>
                    <span>${{ number_format($ivaMxn, 2) }} MXN</span>
                </div>
                <div class="flex justify-between items-end pt-4 mt-4 border-t border-slate-200">
                    <div>
                        <span class="block text-sm text-slate-500 mb-1">Tipo de cambio aplicado: 1 USD = ${{ number_format($exchangeRate, 2) }} MXN</span>
                        <span class="text-xl font-bold text-slate-900">Total a Pagar</span>
                    </div>
                    <div class="text-right">
                        <span class="block text-2xl font-black text-indigo-600">${{ number_format($totalMxn, 2) }} <span class="text-sm">MXN</span></span>
                        <span class="block text-sm font-medium text-slate-500">~ ${{ number_format($totalUsd, 2) }} USD</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
