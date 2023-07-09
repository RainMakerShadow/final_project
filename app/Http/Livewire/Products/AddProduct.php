<?php

namespace App\Http\Livewire\Products;

use App\Models\ProductsCategories;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;
    public $image;
    public $categories;

    public function mount(){
        $this->categories=ProductsCategories::all();
    }

    public function render()
    {
        $categories=$this->categories;
        return view('products.add-product', compact('categories'));
    }
}
