<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use App\Models\NewsCategory;
use Livewire\Component;

class ShowNews extends Component
{

    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $imageUrl;
    public $news_categories;
    public $news;

    public $order='asc';

    public function mount(){
        $this->news=News::all();
        $this->news_categories=NewsCategory::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->news = News::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->news = News::query()->orderByDesc($order)->get();
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

        $this->news = News::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }
    public function render()
    {
        return view('news.show-news')->layout('layouts.admin');
    }
}
