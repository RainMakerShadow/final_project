<?php

namespace App\Http\Livewire;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Livewire\Component;

class NewsShow extends Component
{
    public $news;
    public $newsCategory;

    public function mount(Request $request){
        $url=$request->getPathInfo();
        $this->newsCategory=NewsCategory::where('link', $url)->get();
        if(count(NewsCategory::where('link', $url)->get()->toArray())){
            $this->news=News::where('category_id', $this->newsCategory[0]->id)->get();
        }
        else{
            $this->newsCategory=NewsCategory::all();
            $this->news=News::all();
        }
    }

    public function render()
    {
        return view('livewire.news-show');
    }
}
