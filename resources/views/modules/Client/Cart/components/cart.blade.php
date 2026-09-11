<div>
    <!-- Botón del carrito flotante para abrirlo, si quisieramos integrarlo globalmente. -->
    
    @if($isOpen)
    <div class="relative z-50" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeCart"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    
                    <!-- Panel -->
                    <div class="pointer-events-auto w-screen max-w-md transform transition ease-in-out duration-500 sm:duration-700">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-2xl">
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-2xl font-extrabold text-slate-900" id="slide-over-title">Tu Carrito</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" wire:click="closeCart" class="relative -m-2 p-2 text-slate-400 hover:text-slate-500 transition-colors">
                                            <span class="absolute -inset-0.5"></span>
                                            <span class="sr-only">Cerrar panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-slate-100">
                                            @forelse($cart as $id => $item)
                                            <li class="flex py-6">
                                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-xl border border-slate-100 bg-slate-50">
                                                    @if($item['imagen'])
                                                        <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" class="h-full w-full object-cover object-center">
                                                    @else
                                                        <div class="h-full w-full flex items-center justify-center text-slate-300">
                                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="ml-4 flex flex-1 flex-col">
                                                    <div>
                                                        <div class="flex justify-between text-base font-medium text-slate-900">
                                                            <h3>
                                                                <a href="#">{{ $item['nombre'] }}</a>
                                                            </h3>
                                                            <p class="ml-4">${{ number_format($item['precio_mxn'] * $item['quantity'], 2) }} <span class="text-xs text-slate-500">MXN</span></p>
                                                        </div>
                                                        <p class="mt-1 text-sm text-slate-500 uppercase tracking-wide">{{ $item['sku'] }}</p>
                                                    </div>
                                                    <div class="flex flex-1 items-end justify-between text-sm">
                                                        <div class="flex items-center space-x-3 bg-slate-50 rounded-lg p-1">
                                                            <button wire:click="updateQuantity({{ $id }}, 'decrease')" class="p-1 text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                                            </button>
                                                            <p class="text-slate-900 font-medium w-4 text-center">{{ $item['quantity'] }}</p>
                                                            <button wire:click="updateQuantity({{ $id }}, 'increase')" class="p-1 text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                            </button>
                                                        </div>

                                                        <div class="flex">
                                                            <button type="button" wire:click="removeItem({{ $id }})" class="font-medium text-red-500 hover:text-red-600 transition-colors">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @empty
                                            <li class="py-12 text-center">
                                                <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                                <p class="text-slate-500 font-medium">Tu carrito está vacío</p>
                                            </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            @if(count($cart) > 0)
                            <div class="border-t border-slate-100 px-4 py-6 sm:px-6 bg-slate-50">
                                <div class="flex justify-between text-base font-bold text-slate-900">
                                    <p>Subtotal</p>
                                    <p>${{ number_format($totalMXN, 2) }} <span class="text-xs text-slate-500 font-normal">MXN</span></p>
                                </div>
                                <p class="mt-1 text-sm text-slate-500">Impuestos y gastos de envío calculados en el checkout.</p>
                                <div class="mt-6">
                                    <a href="/checkout" class="flex items-center justify-center rounded-xl border border-transparent bg-indigo-600 px-6 py-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 transition-all duration-200 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Proceder al Pago
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-slate-500">
                                    <p>
                                        o
                                        <button type="button" wire:click="closeCart" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                                            Continuar Comprando
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
