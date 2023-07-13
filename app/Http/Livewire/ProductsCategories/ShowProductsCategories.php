<?php

namespace App\Http\Livewire\ProductsCategories;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Menu;
use App\Models\ProductsCategories;

class ShowProductsCategories extends Component
{

/*    public $title;
    public $img_title;
    public $img;
    public $img_alt;
    public $img_descr;
    public $description;
    public $keywords;
    public $menu_id;
    public $link;*/

    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $imageUrl;
    public $products_categories;
    public $menu;
    public $order='asc';

    public function mount(){
        $this->imageUrl=Storage::url('image/products/vinograd-oskar.webp');
        $this->products_categories=ProductsCategories::all();
        $this->menu=Menu::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->products_categories = ProductsCategories::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->products_categories = ProductsCategories::query()->orderByDesc($order)->get();
            $this->order='asc';
        }

        $this->render();
    }

    public function check($id, $checked){ //обработка действий по клику выбора иформирование массива ID для удаления

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
    public function handleInput(){
        $title=$this->search;

        $this->products_categories = ProductsCategories::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }

    public function render()
    {
        $products_categories=$this->products_categories;
        $menu=$this->menu;
        return view('products-categories.show-products-categories', compact('products_categories', 'menu'));
    }
}
