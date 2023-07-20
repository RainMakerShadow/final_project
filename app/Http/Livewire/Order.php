<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Order extends Component
{
    protected $listeners = ['order'=>'render'];

    public function render()
    {
        return view('livewire.order');
    }
}
