<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductsCategories;
use Livewire\Component;
use Illuminate\Http\Request;

class Shop extends Component
{
    public $category;
    public $products;

    public function mount(Request $request){
        $priceMin = $request->session()->get('priceMin');
        $priceMax = $request->session()->get('priceMax');
        $category_list=$request->session()->get('category_list');

        if ($category_list){
            $this->products=Product::whereIn('category_id', $category_list)
                ->where(function ($query) use ($priceMin, $priceMax) {
                $query->where('price', '>=', $priceMin);
            })
                ->where(function ($query) use ($priceMin, $priceMax) {
                    $query->where('price', '<=', $priceMax);
                })
                ->get();

            $this->render();
        }
        else{
            $url = url()->current();

            $url=substr($url, strrpos($url,'/'));
            $categories=ProductsCategories::all();
            if(request()->route()->uri() ==='shop')
            {
                $this->products=Product::all();
            }
            else{
                foreach ($categories as $category){

                    if(substr($category->link, strrpos($category->link,'/'))==$url){
                        $this->products=Product::query()->where('category_id', 'LIKE', "%{$category->id}%")->get();
                    }
                }
            }
        }

    }

    public function AddToBasket($target){
        dd($target);
    }

    public function render()
    {
        $products=$this->products;
        return view('livewire.shop', compact('products'));
    }
}
