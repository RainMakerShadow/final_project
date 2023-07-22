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
    public $hidden='hidden overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full';

    public $summ;
    public $isRender=false;

    protected $listeners = ['updateOrders'=>'updateWithoutStyle','updateOrdersWithClass'=>'update'];

    public function mount(){
        $this->orders=null;
        $this->count=null;

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
        }
    }

    public function inputClick($id, $value){
        $this->orders=null;
        $this->count=null;
        $this->summ=0;
        $orderItem=OrderItem::where('product_id', $id)->where('user_id',Session::get('user_id'))->where('done', false)->first();
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
        }
        $this->hidden='overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex';

        $this->render();
    }

    public function deleteItem($id){
        $this->orders=null;
        $this->count=null;
        $this->summ=0;

        if(OrderItem::destroy($id)){
            $this->emit("updateCounterDelete");
            if(Session::get('user_id')){
                if (OrderItem::query()->where('user_id',Session::get('user_id') )->where('done', false)->count()){
                    //$this->render();
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
            }
                    $this->render();
        }
        $this->hidden='overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex';
    }
    public function update(){
        $this->isRender=true;
        $this->hidden='overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex';

        $this->render();
    }
    public function redirectTo(){
        redirect()->route('order.page');
    }

    public function updateWithoutStyle(){
        $this->isRender=true;
        $this->hidden='hidden overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full';
        $this->render();
    }
    public function render()
    {
        if ($this->isRender){

            $this->orders=null;
            $this->count=null;
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
                }
            }
            $this->isRender=false;
        }
        $orders=$this->orders;
        $count=$this->count;

        $message=(count(OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->get()))?false:"Ваш кошик порожній...";
        return view('livewire.basket', compact('orders', 'count', 'message') );
    }
}
