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
    public $hidden='fixed top-0 left-0 right-0 z-50 hidden -full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full';
    public $summ;

    protected $listeners = ['updateOrders'=>'update'];

    public function mount(){
        $this->summ=0;
        if(Session::get('user_id')){
            if (OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->count()){
                $this->isOrders=true;
                $orders=OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->get();
                if(OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get()){
                    foreach ($orders as $order){
                        $this->arrOrders[]=$order->product_id;
                    }
                    $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                    $this->count = OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->get();
                }

                foreach ($orders as $order){
                    foreach ($this->orders as $product){
                        if($product->id == $order->product_id){
                            $this->summ+=($product->discount)
                                ? ($product->price-($product->price*$product->discount)/100) * $order->quantity
                                :  $product->price*$order->quantity;
                        }
                    }
                }
            }
            else{
                $this->message="Ваш кошик порожній...";
            }
        }
    }

    public function inputClick($id, $value){
        $this->summ=0;
        $orderItem=OrderItem::where('product_id', $id)->first();
        $orderItem->quantity=$value;
        $orderItem->save();
        if(Session::get('user_id')){
            if (OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->count()){
                $this->isOrders=true;
                $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get();
                if(OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get()){
                    foreach ($orders as $order){
                        $this->arrOrders[]=$order->product_id;
                    }
                    $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                    $this->count = OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->get();
                }
                foreach ($orders as $order){
                    foreach ($this->orders as $product){
                        if($product->id == $order->product_id){
                            $this->summ+=($product->discount)
                                ? ($product->price-($product->price*$product->discount)/100) * $order->quantity
                                :  $product->price*$order->quantity;
                        }
                    }
                }
            }
            else{
                $this->message="Ваш кошик порожній...";
            }
            $this->hidden='fixed top-0 left-0 right-0 z-50 -full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex ';
            $this->render();
        }
    }

    public function deleteItem($id){
        //$this->hidden='fixed top-0 left-0 right-0 z-50 -full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex ';
        $this->summ=0;
        if(OrderItem::destroy($id)){
            $this->emit("updateCounter");
            if(Session::get('user_id')){
                if (OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->count()){
                    $this->isOrders=true;
                    $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get();
                    if(OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get()){
                        foreach ($orders as $order){
                            $this->arrOrders[]=$order->product_id;
                        }
                        $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                        $this->count = OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->get();
                    }
                    foreach ($orders as $order){
                        foreach ($this->orders as $product){
                            if($product->id == $order->product_id){
                                $this->summ+=($product->discount)
                                    ? ($product->price-($product->price*$product->discount)/100) * $order->quantity
                                    :  $product->price*$order->quantity;
                            }
                        }
                    }
                }
                else{
                    $this->message="Ваш кошик порожній...";
                }
            }
        }
        $this->mount();
    }
    public function update(){
        $this->hidden='fixed top-0 left-0 right-0 z-50 -full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex ';
        $this->summ=0;
        if(Session::get('user_id')){
            if (OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->count()){
                $this->isOrders=true;
                $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get();
                if(OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->get()){
                    foreach ($orders as $order){
                        $this->arrOrders[]=$order->product_id;
                    }
                    $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
                    $this->count = OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->get();
                }
                foreach ($orders as $order){
                    foreach ($this->orders as $product){
                        if($product->id == $order->product_id){
                            $this->summ+=($product->discount)
                                ? ($product->price-($product->price*$product->discount)/100) * $order->quantity
                                :  $product->price*$order->quantity;
                        }
                    }
                }
               $this->render();
            }
            else{
                $this->message="Ваш кошик порожній...";
            }
        }
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
