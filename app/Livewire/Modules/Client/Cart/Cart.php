<?php

namespace App\Livewire\Modules\Client\Cart;

use Livewire\Component;
use App\Core\Catalog\Models\Product;
use Livewire\Attributes\On;

class Cart extends Component
{
    public $cart = [];
    public $isOpen = false;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    #[On('cart-updated')]
    public function openCart()
    {
        $this->cart = session()->get('cart', []);
        $this->isOpen = true;
    }

    public function closeCart()
    {
        $this->isOpen = false;
    }

    public function updateQuantity($productId, $action)
    {
        $product = Product::find($productId);
        if (!$product) return;

        if (isset($this->cart[$productId])) {
            if ($action === 'increase' && $this->cart[$productId]['quantity'] < $product->stock) {
                $this->cart[$productId]['quantity']++;
            } elseif ($action === 'decrease' && $this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
            }
            session()->put('cart', $this->cart);
            $this->dispatch('cart-refreshed');
        }
    }

    public function removeItem($productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            session()->put('cart', $this->cart);
            $this->dispatch('cart-refreshed');
        }
    }

    public function render()
    {
        $totalUSD = 0;
        $totalMXN = 0;

        foreach ($this->cart as $item) {
            $totalUSD += $item['precio_usd'] * $item['quantity'];
            $totalMXN += $item['precio_mxn'] * $item['quantity'];
        }

        return view('modules.Client.Cart.components.cart', [
            'totalUSD' => $totalUSD,
            'totalMXN' => $totalMXN
        ]);
    }
}
