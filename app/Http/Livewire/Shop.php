<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductsCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\Menu;

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
            //dd(request()->route()->uri() ==='order');
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

    public function submit($product_id){

        if (!Session::has('user_id')) {
            $user_id = uniqid();
            Session::put('user_id', $user_id);
        } else {
            $user_id = Session::get('user_id');
        }
        $orderItem=OrderItem::where('product_id', $product_id)->where('done',0)->first();

        if(!$orderItem){
            OrderItem::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'quantity'=>1,
                'done'=> false,
                'order_id'=> 0,
            ]);
            $this->emit("updateCounter");
        }
        else{
            $orderItem->quantity+=1;
            $orderItem->save();
        }
    }

    public function render()
    {
        $products=$this->products;
        return view('livewire.shop', compact('products'));
    }
}
