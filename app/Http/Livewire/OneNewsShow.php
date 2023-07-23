<?php

namespace App\Http\Livewire;

use App\Models\News;
use Illuminate\Http\Request;
use Livewire\Component;

class OneNewsShow extends Component
{
    public $news;
    public $news_list;

    public function mount(Request $request){
        $url=$request->getPathInfo();
        $this->news=News::where('link', $url)->get();
        $this->news_list=News::where('category_id', $this->news[0]->category_id)->where('id','<>', $this->news[0]->id)->limit(4)->get();
    }
    public function render()
    {
        return view('livewire.one-news-show');
    }
}
