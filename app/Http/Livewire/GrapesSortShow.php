<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\GrapesSort;

class GrapesSortShow extends Component
{
    public $grapes;

    public function mount(Request $request){
        $url=$request->getPathInfo();
        $this->grapes=GrapesSort::all();
    }
    public function render()
    {
        return view('livewire.grapes-sort-show');
    }
}
