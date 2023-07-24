<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\GrapesSort;

class GrapesSortShow extends Component
{
    private $paginate=[];

    public function render()
    {
        $this->paginate=GrapesSort::paginate(4);
        return view('livewire.grapes-sort-show', ['paginate'=>$this->paginate]);
    }
}
