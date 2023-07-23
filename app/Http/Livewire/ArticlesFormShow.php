<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Livewire\Component;

class ArticlesFormShow extends Component
{
    public $articles;
    public $articleCategory;

    public function mount(Request $request){
        $url=$request->getPathInfo();
        $this->articleCategory=ArticleCategory::where('link', $url)->get();
        if(count(ArticleCategory::where('link', $url)->get()->toArray())){
            $this->articles=Article::where('category_id', $this->articleCategory[0]->id)->get();
        }
        else{
            $this->articleCategory=ArticleCategory::all();
            $this->articles=Article::all();
        }
    }
    public function render()
    {
        return view('livewire.articles-form-show');
    }
}
