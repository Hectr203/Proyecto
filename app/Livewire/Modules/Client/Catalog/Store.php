<?php

namespace App\Livewire\Modules\Client\Catalog;

use App\Core\Catalog\Models\Product;
use App\Core\Catalog\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Store extends Component
{
    public $category_id = '';
    public $search = '';

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        
        if (!$product || $product->stock <= 0) {
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] < $product->stock) {
                $cart[$productId]['quantity']++;
            }
        } else {
            // Include precio_usd as calculated by Accessor or column
            $cart[$productId] = [
                'nombre' => $product->nombre,
                'precio_mxn' => $product->precio_mxn,
                'precio_usd' => $product->precio_usd ?? ($product->precio_mxn / (\App\Core\Catalog\Services\ExchangeRateService::getUsdToMxnRate() ?: 1)),
                'quantity' => 1,
                'imagen' => $product->image_url,
                'sku' => $product->sku ?? 'N/A'
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $query = Product::where('activo', true);

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('descripcion_corta', 'like', '%' . $this->search . '%');
            });
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::orderBy('name')->get();

        return view('modules.Client.Catalog.pages.store', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
