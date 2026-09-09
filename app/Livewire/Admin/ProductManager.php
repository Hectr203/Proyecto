<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    
    // Propiedades del formulario
    public $productId;
    public $sku, $nombre, $descripcion_corta, $descripcion_larga;
    public $precio_usd, $precio_mxn, $stock, $fecha_vigencia, $activo = true;
    
    public $showModal = false;

    // Reinicia la paginación cuando se realiza una búsqueda
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'sku' => 'required|unique:products,sku,' . $this->productId,
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/', // Validamos letras y espacios, sin caracteres especiales ni acentos
            'descripcion_corta' => 'required|string|max:255',
            'precio_usd' => 'required|numeric|gt:0',
            'precio_mxn' => 'required|numeric|gt:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'nombre.regex' => 'El nombre no debe contener acentos ni caracteres especiales.',
            'precio_usd.gt' => 'El precio USD debe ser mayor a 0.',
            'precio_mxn.gt' => 'El precio MXN debe ser mayor a 0.',
            'sku.unique' => 'Este SKU ya se encuentra registrado.',
            'required' => 'Este campo es obligatorio.',
        ];
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        $this->productId = $product->id;
        $this->sku = $product->sku;
        $this->nombre = $product->nombre;
        $this->descripcion_corta = $product->descripcion_corta;
        $this->descripcion_larga = $product->descripcion_larga;
        $this->precio_usd = $product->precio_usd;
        $this->precio_mxn = $product->precio_mxn;
        $this->stock = $product->stock;
        $this->fecha_vigencia = $product->fecha_vigencia;
        $this->activo = $product->activo;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        Product::updateOrCreate(['id' => $this->productId], [
            'sku' => $this->sku,
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            'precio_usd' => $this->precio_usd,
            'precio_mxn' => $this->precio_mxn,
            'stock' => $this->stock,
            'fecha_vigencia' => $this->fecha_vigencia,
            'activo' => $this->activo,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function toggleActivo($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['activo' => !$product->activo]);
    }

    private function resetInputFields()
    {
        $this->productId = null;
        $this->sku = '';
        $this->nombre = '';
        $this->descripcion_corta = '';
        $this->descripcion_larga = '';
        $this->precio_usd = '';
        $this->precio_mxn = '';
        $this->stock = 0;
        $this->fecha_vigencia = null;
        $this->activo = true;
    }

    public function render()
    {
        $products = Product::where('sku', 'like', '%' . $this->search . '%')
            ->orWhere('nombre', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.product-manager', [
            'products' => $products
        ]);
    }
}
