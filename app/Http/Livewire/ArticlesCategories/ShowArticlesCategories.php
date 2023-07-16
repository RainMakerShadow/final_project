<?php

namespace App\Http\Livewire\ArticlesCategories;

use App\Models\ArticleCategory;
use App\Models\Menu;
use Livewire\Component;

class ShowArticlesCategories extends Component
{

    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $imageUrl;
    public $articles_categories;
    public $menu;
    public $order='asc';

    public function mount(){
        $this->articles_categories=ArticleCategory::all();
        $this->menu=Menu::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->articles_categories = ArticleCategory::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->articles_categories = ArticleCategory::query()->orderByDesc($order)->get();
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

        $this->articles_categories = ArticleCategory::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }
    public function render()
    {
        $articles_categories=$this->articles_categories;
        $menu=$this->menu;
        return view('articles-categories.show-articles-categories', compact('articles_categories', 'menu'))->layout('layouts.admin');
    }
}
