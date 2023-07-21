<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CardMenu extends Component
{
    public $ifOrders;

    protected $listeners = ['updateCounter'=>'count'];

    public function mount()
    {
        if(Session::get('user_id')){
            $this->ifOrders=(OrderItem::query()->where('user_id', Session::get('user_id'))->count()) ? OrderItem::query()->where('user_id', Session::get('user_id'))->count():'';
        }
    }

    public function count(){
        if(Session::get('user_id')){
            $this->ifOrders=OrderItem::query()->where('user_id', Session::get('user_id'))->count();
        }
        //$this->emit("updateOrders");
    }

    public function render()
    {
        return view('livewire.card-menu');
    }
}
