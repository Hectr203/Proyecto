<?php

namespace App\Livewire\Modules\Client\Cart;

use Livewire\Component;
use Livewire\Attributes\On;

class CartWidget extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCartCount();
    }

    #[On('cart-updated')]
    #[On('cart-refreshed')]
    public function updateCartCount()
    {
        $cart = session()->get('cart', []);
        $this->cartCount = array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.modules.client.cart.cart-widget');
    }
}
