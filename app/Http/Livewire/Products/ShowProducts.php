<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\ProductsCategories;
use Livewire\Component;

class ShowProducts extends Component
{
    public $products;
    public $categories;
    public $checkedAll='';
    public $toDelete=[];
    public $search;

    public function mount(){
        $this->products=Product::all();
        $this->categories=ProductsCategories::all();
    }

    public function handleInput(){
        $name=$this->search;

        $this->products = Product::query()->select()->where('name', 'LIKE', "%{$name}%")->get();

        $this->render();
    }
    public function check($id, $checked){ //обработка действий по клику выбора пользователя и формируется массив ID пользователей для удаления

        if($checked==true){
            array_push($this->toDelete, $id);
        }
        else{
            $key = array_search($id, $this->toDelete);
            unset($this->toDelete[$key]);
        }
    }
    //Нужно обработать формирование массива для удаления всех пользователей

    public function checked(){ // Обработка события выделения всех пользователей
        if ($this->checkedAll===''){
            $this->checkedAll="checked";
        }
        else{
            $this->checkedAll='';
        }

    }
    public function render()
    {
        $products = $this->products;
        $categories = $this->categories;

        return view('products.show-products', compact('products', 'categories'));
    }
}
