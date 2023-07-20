<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Menu as MenuModel;
use App\Models\ArticleCategory;
use App\Models\ProductsCategories;
use App\Models\NewsCategory;

class Menu extends Component
{
    public $route;


    public function mount()
    {
        $this->route = Route::currentRouteName();
        if(Session::get('user_id')){
            $this->ifOrders=OrderItem::query()->where('user_id', Session::get('user_id'))->count();
        }
    }

    public function render()
    {
        $menu=MenuModel::all();
        $articlesCategories=ArticleCategory::all();
        $newsCategories = NewsCategory::all();
        $productsCategories = ProductsCategories::all();
        return view('livewire.menu', compact('menu', 'newsCategories', 'articlesCategories', 'productsCategories'));
    }
}
