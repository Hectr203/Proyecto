<button wire:click="$dispatch('open-cart')" aria-label="Shopping Cart" class="relative text-on-surface hover:text-primary transition-colors flex items-center justify-center p-2 rounded-full hover:bg-surface-container-low cursor-pointer">
    <span class="material-symbols-outlined text-[24px]">shopping_cart</span>
    @if($cartCount > 0)
        <span class="absolute top-0 right-0 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white ring-2 ring-surface border-0 shadow-sm">{{ $cartCount }}</span>
    @endif
</button>
