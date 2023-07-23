<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Menu;
use Livewire\Component;

class ShowArticles extends Component
{

    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $imageUrl;
    public $articles_categories;
    public $articles;

    public $order='asc';

    public function mount(){
        $this->articles=Article::all();
        $this->articles_categories=ArticleCategory::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->articles = Article::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->articles = Article::query()->orderByDesc($order)->get();
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

        $this->articles = Article::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }
    public function render()
    {
        return view('articles.show-articles')->layout('layouts.admin');
    }
}
