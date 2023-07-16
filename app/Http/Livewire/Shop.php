<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductsCategories;
use Livewire\Component;

class Shop extends Component
{
    public $category;
    public $products;

    public function mount(){
        $url = url()->current();
        $url=substr($url, strrpos($url,'/'));
        $categories=ProductsCategories::all();
        foreach ($categories as $category){

            if(substr($category->link, strrpos($category->link,'/'))==$url){
                $this->products=Product::query()->where('category_id', 'LIKE', "%{$category->id}%")->get();
            }
        }

    }
    public function render()
    {
        $products=$this->products;
        return view('livewire.shop', compact('products'));
    }
}
