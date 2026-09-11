<?php

namespace App\Livewire\Modules\Admin\Categories;

use App\Core\Catalog\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CategoryManager extends Component
{
    public $name;
    
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        
        Category::create([
            'name' => $this->name,
        ]);
        
        $this->reset('name');
        
        session()->flash('message', 'Categoría creada exitosamente.');
    }
    
    public function delete($id)
    {
        Category::find($id)->delete();
    }

    public function render()
    {
        return view('modules.Admin.Categories.pages.index', [
            'categories' => Category::orderBy('name')->get()
        ]);
    }
}
