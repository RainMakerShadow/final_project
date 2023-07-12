<?php

namespace App\Http\Livewire\ProductsCategories;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Menu;
use App\Models\ProductsCategories;

class ShowProductsCategories extends Component
{

    public $title;
    public $img_title;
    public $img;
    public $img_alt;
    public $img_descr;
    public $description;
    public $keywords;
    public $menu_id;
    public $link;


    public $checkedAll;
    public $toDelete=[];
    public $imageUrl;
    public $products_categories;
    public $menu;

    public function mount(){
        $this->imageUrl=Storage::url('image/products/vinograd-oskar.webp');

        $this->products_categories=ProductsCategories::all();
        $this->menu=Menu::all();
    }

    public function render()
    {
        $products_categories=$this->products_categories;
        $menu=$this->menu;
        return view('products-categories.show-products-categories', compact('products_categories', 'menu'));
    }
}
