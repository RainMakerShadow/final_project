<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        return view('livewire.orders')->layout('layouts.admin');
    }
}
