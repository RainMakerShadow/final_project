<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Livewire\Component;

class ArticlesFormShow extends Component
{
    public $articles;

    public function mount(Request $request){
        $this->counter=0;
        $url=$request->getPathInfo();
        $articleCategory=ArticleCategory::where('link', $url)->get();
        $this->articles=Article::where('category_id', $articleCategory[0]->id)->get();
    }
    public function render()
    {
        return view('livewire.articles-form-show');
    }
}
