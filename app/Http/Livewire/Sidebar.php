<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductsCategories;
use Illuminate\Http\Request;
use Livewire\Component;

class Sidebar extends Component
{
    public $categories;
    public $category=[];
    public $priceMin;
    public $priceMax;
    public $message;


    public function mount(Request $request){
        $this->categories=ProductsCategories::all();
        $this->priceMin=($request->session()->get('priceMin')) ? $request->session()->get('priceMin') : Product::min('price');
        $this->priceMax=($request->session()->get('priceMax')) ? $request->session()->get('priceMax') : Product::max('price');


    }
    public function submit(Request $request){
        $request->session()->put('priceMin', $this->priceMin);
        $request->session()->put('priceMax', $this->priceMax);
        $request->session()->put('category_list', $this->category);
        if($this->category){
            return redirect()->route('shop.page');
        }
        else{
            $this->message='Оберіть хочаб одну категорію';
        }
    }
    public function handleCheckboxFilter($id, $checked){

        if($checked==true){
            array_push($this->category, $id);
        }
        else{
            $key = array_search($id, $this->category);
            unset($this->category[$key]);
        }

    }

    public function render()
    {
        $priceMin=$this->priceMin;
        $priceMax=$this->priceMax;
        $categories=$this->categories;
        return view('livewire.sidebar', compact('categories','priceMax', 'priceMin'));
    }
}
