<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Basket extends Component
{
    public $isOrders;
    public $arrOrders=[];
    public $orders;
    public $count;
    public $message;
    public $hidden=true;

    protected $listeners = ['updateOrders'=>'update'];

    public function mount(){
        if(Session::get('user_id')){
            if (OrderItem::query()->where('user_id',Session::get('user_id') )->count()){
                $this->isOrders=true;
                $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->get();
                if(OrderItem::query()->where('user_id',Session::get('user_id') )->get()){
                    foreach ($orders as $order){
                        $this->arrOrders[]=$order->product_id;
                    }
                    $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                    $this->count = OrderItem::all();
                }
            }
            else{
                $this->message="Ваш кошик порожній...";
            }
        }
    }

    public function inputClick($id, $value){
        $orderItem=OrderItem::where('product_id', $id)->first();
        $orderItem->quantity=$value;
        $orderItem->save();
        if(Session::get('user_id')){
            if (OrderItem::query()->where('user_id',Session::get('user_id') )->count()){
                $this->isOrders=true;
                $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->get();
                if(OrderItem::query()->where('user_id',Session::get('user_id') )->get()){
                    foreach ($orders as $order){
                        $this->arrOrders[]=$order->product_id;
                    }
                    $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                    $this->count = OrderItem::all();
                }
            }
            else{
                $this->message="Ваш кошик порожній...";
            }
        }
        $this->hidden=false;
        $this->render();
    }

    public function deleteItem($id){
        if(OrderItem::destroy($id)){
            $this->emit("updateCounter");
            if(Session::get('user_id')){
                if (OrderItem::query()->where('user_id',Session::get('user_id') )->count()){
                    $this->isOrders=true;
                    $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->get();
                    if(OrderItem::query()->where('user_id',Session::get('user_id') )->get()){
                        foreach ($orders as $order){
                            $this->arrOrders[]=$order->product_id;
                        }
                        $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                        $this->count = OrderItem::all();
                    }
                }
                else{
                    $this->message="Ваш кошик порожній...";
                }
            }
            $this->hidden=false;
            $this->render();
        }
    }
    public function update(){
        $this->hidden=true;
        if(Session::get('user_id')){
            if (OrderItem::query()->where('user_id',Session::get('user_id') )->count()){
                $this->isOrders=true;
                $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->get();
                if(OrderItem::query()->where('user_id',Session::get('user_id') )->get()){
                    foreach ($orders as $order){
                        $this->arrOrders[]=$order->product_id;
                    }
                    $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                    $this->count = OrderItem::all();
                }
            }
            else{
                $this->message="Ваш кошик порожній...";
            }
        }
        $this->render();
    }

    public function redirectTo(){
        redirect()->route('order.page');
    }

    public function render()
    {
        $orders=$this->orders;
        $count=$this->count;
        return view('livewire.basket', compact('orders', 'count'));
    }
}
