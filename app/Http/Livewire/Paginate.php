<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Paginate extends Component
{
    private $paginate=[];

    public function render()
    {
        dd($this->paginate);
        return view('livewire.paginate', ['paginate'=>$this->paginate]);
    }
}
