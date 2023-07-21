<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

class Orders extends Component
{
    public $orders;
    public $order_modal;
    public $products;
    public $ordersItem;
    public $checkedAll='';
    public $toDelete=[];
    public $search;
    public $temp;
    public $hidden='hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full';
    public $order='asc';

    public $modal_email;
    public $modal_phone;
    public $modal_client_name;

    public function mount(){
        $this->orders=Order::all();
        $currentRoute = Route::current();
        if($currentRoute->getName()==="orders.show"){

        }

    }
    public function sort ($order){ //сортировка колонок таблицы
        $this->hidden='hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full';

        if($this->order==='asc') {
            $this->orders =Order::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->orders = Order::query()->orderByDesc($order)->get();
            $this->order='asc';
        }

        $this->render();
    }

    //выборка информации о заказе

    public function onClick($id){
        $this->order_modal=Order::query()->join('orders_items', 'orders.id','=','orders_items.order_id')->join('products','orders_items.product_id', '=', 'products.id')->select('orders.*', 'orders_items.*', 'products.price', 'products.title', 'products.discount')->where('orders.id', $id)->get();
        //dd($this->order_modal);
        $this->modal_client_name=$this->order_modal[0]->last_name." ".$this->order_modal[0]->first_name;



        $this->hidden='overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex';
        $this->render();
    }









    public function handleInput(){ //поиск
        $name=$this->search;

        $this->orders = Order::query()->select()->where('title', 'LIKE', "%{$name}%")->get();

        $this->render();
    }
    public function check($id, $checked){ //обработка действий по клику выбора пользователя и формируется массив ID пользователей для удаления
        if($checked==true){
            array_push($this->toDelete, $id);
        }
        else{
            $key = array_search($id, $this->toDelete);
            unset($this->toDelete[$key]);
        }
    }

    public function checked(){ // Обработка события выделения всех пользователей
        if ($this->checkedAll===''){
            $this->checkedAll="checked";
        }
        else{
            $this->checkedAll='';
        }

    }
    public function render()
    {
        return view('livewire.orders')->layout('layouts.admin');
    }
}
