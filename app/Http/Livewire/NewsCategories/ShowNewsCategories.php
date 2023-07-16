<?php

namespace App\Http\Livewire\NewsCategories;

use App\Models\Menu;
use App\Models\NewsCategory;
use Livewire\Component;

class ShowNewsCategories extends Component
{

    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $imageUrl;
    public $news_categories;
    public $menu;
    public $order='asc';

    public function mount(){
        $this->news_categories=NewsCategory::all();
        $this->menu=Menu::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->news_categories = NewsCategory::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->news_categories = NewsCategory::query()->orderByDesc($order)->get();
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

        $this->news_categories = NewsCategory::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }
    public function render()
    {
        $news_categories=$this->news_categories;
        $menu=$this->menu;
        return view('news-categories.show-news-categories', compact('news_categories', 'menu'))->layout('layouts.admin');
    }
}
