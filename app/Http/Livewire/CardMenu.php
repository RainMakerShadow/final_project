<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CardMenu extends Component
{
    public $ifOrders;

    protected $listeners = ['updateCounter'=>'count','updateCounterDelete'=>'countDelete'];

    public function mount()
    {
        if(Session::get('user_id')){
            $this->ifOrders=(OrderItem::query()->where('user_id', Session::get('user_id'))->where('done', false)->count()) ? OrderItem::query()->where('user_id', Session::get('user_id'))->where('done', false)->count():'';
        }
    }

    public function count(){
        if(Session::get('user_id')){
            $this->ifOrders=OrderItem::query()->where('user_id', Session::get('user_id'))->where('done', false)->count();
            $this->emit("updateOrders");
        }
    }
    public function countDelete(){
        if(Session::get('user_id')){
            $this->ifOrders=OrderItem::query()->where('user_id', Session::get('user_id'))->where('done', false)->count();
        }
    }
    public function updateBasket(){
        $this->emit("updateOrdersWithClass");
    }
    public function render()
    {
        return view('livewire.card-menu');
    }
}
