<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\GrapesSort;

class OneGrapeSortShow extends Component
{

    public $grape;
    public $new_list;

    public function mount(Request $request){
        $url=$request->getPathInfo();
        $this->grape=GrapesSort::where('link', $url)->get();
        $this->news_list=GrapesSort::where('link','<>', $this->grape[0]->link)->limit(4)->get();
    }
    public function render()
    {
        return view('livewire.one-grape-sort-show');
    }
}
