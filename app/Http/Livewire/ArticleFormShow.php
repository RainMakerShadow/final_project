<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Illuminate\Http\Request;
use Livewire\Component;

class ArticleFormShow extends Component
{
    public $article;
    public $articles_list;

    public function mount(Request $request){
        $url=$request->getPathInfo();
        $this->article=Article::where('link', $url)->get();
        $this->articles_list=Article::where('category_id', $this->article[0]->category_id)->where('id','<>', $this->article[0]->id)->limit(4)->get();
    }
    public function render()
    {
        return view('livewire.article-form-show');
    }
}
