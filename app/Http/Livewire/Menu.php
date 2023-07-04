<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Menu as MenuModel;
use App\Models\ArticleCategory;
use App\Models\ProductsCategories;
use App\Models\NewsCategory;

class Menu extends Component
{
    public function render()
    {
        $menu=MenuModel::all();
        $articleCategories=ArticleCategory::all();
        $newsCategories = NewsCategory::all();
        $productsCategories = ProductsCategories::all();
        return view('livewire.menu', compact('menu', 'newsCategories', 'articleCategories', 'productsCategories'));
    }
}
