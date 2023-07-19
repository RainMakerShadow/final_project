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
        //$this->category=$request->session()->get('category_list');


    }
    public function submit(Request $request){

        //dd($this->category);
        if(!$this->category){
            $this->addError('checkedBox', 'Оберіть хочаб одну категорію');
        }
        else{
            $request->session()->put('priceMin', $this->priceMin);
            $request->session()->put('priceMax', $this->priceMax);
            $request->session()->put('category_list', $this->category);
            return redirect()->route('shop.page');

        }

    }
    public function handleCheckboxFilter($id, $checked){
        if($checked==true){
           $this->category[]=$id;
;
        }
        elseif(array_search($id, $this->category)){
            $key = array_search($id, $this->category);
            unset($this->category[$key]);
        }


    }

    public function render()
    {
        $priceMin=$this->priceMin;
        $priceMax=$this->priceMax;
        $categories=$this->categories;
        $inputChecked=$this->category;
        return view('livewire.sidebar', compact('categories','priceMax', 'priceMin', 'inputChecked') );
    }
}
