<?php

namespace App\Livewire\Modules\Client\Catalog;

use App\Core\Catalog\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class PublicCatalog extends Component
{
    use WithPagination;

    public $search = '';
    public $category_filter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            // Validar stock antes de sumar
            if ($cart[$productId]['quantity'] < $product->stock) {
                $cart[$productId]['quantity']++;
            } else {
                $this->addError('cart', 'No hay más stock disponible para este producto.');
                return;
            }
        } else {
            $cart[$productId] = [
                'nombre' => $product->nombre,
                'sku' => $product->sku,
                'precio_usd' => $product->precio_usd,
                'precio_mxn' => $product->precio_mxn,
                'imagen' => $product->imagen,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $query = Product::where('activo', true);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('sku', 'like', '%' . $this->search . '%')
                  ->orWhere('nombre', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category_filter) {
            $query->where('category_id', $this->category_filter);
        }

        $products = $query->paginate(12);

        return view('modules.Client.Catalog.pages.public-catalog', [
            'products' => $products,
            'categories' => \App\Core\Catalog\Models\Category::all()
        ]);
    }
}
