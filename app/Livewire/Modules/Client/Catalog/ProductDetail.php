<?php

namespace App\Livewire\Modules\Client\Catalog;

use App\Core\Catalog\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    public $product;

    public function mount($sku)
    {
        $this->product = Product::where('sku', $sku)->where('activo', true)->firstOrFail();
    }

    public function addToCart()
    {
        if ($this->product->stock <= 0) {
            return;
        }

        $cart = session()->get('cart', []);
        $productId = $this->product->id;

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] < $this->product->stock) {
                $cart[$productId]['quantity']++;
            }
        } else {
            $cart[$productId] = [
                'nombre' => $this->product->nombre,
                'precio_mxn' => $this->product->precio_mxn,
                'precio_usd' => $this->product->precio_usd ?? ($this->product->precio_mxn / (\App\Core\Catalog\Services\ExchangeRateService::getUsdToMxnRate() ?: 1)),
                'quantity' => 1,
                'imagen' => $this->product->image_url,
                'sku' => $this->product->sku
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('modules.Client.Catalog.pages.product-detail');
    }
}
