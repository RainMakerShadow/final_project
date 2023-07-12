<?php

namespace App\Http\Livewire\ProductsCategories;

use App\Models\ProductsCategories;
use Livewire\Component;

class EditProductsCategories extends Component
{

    public $product_category;
    public $title;

    public function mount($id){
        $this->product_category=ProductsCategories::find($id);
        $this->title=$this->product_category->title;
    }
    public function render()
    {
        $product_category=$this->product_category;
        return view('products-categories.edit-products-categories', compact('product_category'));
    }
}
