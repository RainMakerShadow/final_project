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

    public $order='asc';

    public function mount(){
        $this->products=Product::all();
        $this->categories=ProductsCategories::all();
    }
    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->products = Product::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->products = Product::query()->orderByDesc($order)->get();
            $this->order='asc';
        }

        $this->render();
    }
    public function handleInput(){ //поиск
        $name=$this->search;

        $this->products = Product::query()->select()->where('title', 'LIKE', "%{$name}%")->get();

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
