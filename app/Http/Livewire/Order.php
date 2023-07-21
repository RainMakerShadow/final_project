<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use GuzzleHttp\Client;

class Order extends Component
{
    public $showDelivery=false;
    public $regions;
    public $cities=[];
    public $select_city;
    public $departments=[];
    public $orders;
    public $arrOrders=[];
    public $select_department;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $comment;
    public $isActiveButton='disabled';

    private $token = '17e486f71ddefb57d8d56ad5c2058000';
    private $url = 'https://api.novaposhta.ua/v2.0/json/';



    public function mount(){
        if(OrderItem::query()->where('user_id',Session::get('user_id') )->where('done',false)->count()){
            $this->isActiveButton='';
        }
    }


    public function changeRadioHandle($target, $checked){
        if($target=='radio-2' && $checked == true){
            $this->showDelivery=true;
        }

        else{
            $this->showDelivery=false;
        }
    }

    public function regionInputHandler()
    {   $this->cities=[];
        $client = new Client();
        $data = [
            "apiKey" => $this->token,
            "modelName" => "Address",
            "calledMethod" => "getSettlements",
            "methodProperties" => [
                'FindByString' => $this->select_city,
            ],
        ];

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ];
        $response = $client->post($this->url, $options);
        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, false);
        foreach ($data->data as $item){
            array_push($this->cities,$item->Description);
        }
        $this->selectDepartment();


    }
    public function selectDepartment(){
        $this->departments=[];
            $client = new Client();
            $data = [
                "apiKey"=> $this->token,
                "modelName"=> "Address",
                "calledMethod"=> "getWarehouses",
                "methodProperties"=>[
                    'CityName'=>$this->select_city,
                ],
            ];

            $options = [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ];
            $response = $client->post($this->url, $options);

            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, false);
            foreach ($data->data as $item){
                array_push($this->departments,$item->Description);
            };
    }

    public function submit(){
        if (OrderItem::query()->where('user_id',Session::get('user_id') )->where('done',false)->count()){
            $this->isOrders=true;
            $orders=OrderItem::query()->where('user_id',Session::get('user_id') )->where('done',false)->get();
            if($orders){
                foreach ($orders as $order){
                    $this->arrOrders[]=$order->product_id;
                }
                $this->orders=Product::query()->whereIn('id', $this->arrOrders)->get();
            }
            $summ=0;
            foreach ($orders as $order){
                foreach ($this->orders as $product){
                    if($product->id == $order->product_id){
                        $summ+=($product->discount)
                            ? ($product->price-($product->price*$product->discount)/100) * $order->quantity
                            :  $product->price*$order->quantity;
                    }
                }
            }

            $new_id=\App\Models\Order::create([
                'user_id' => Session::get('user_id'),
                'first_name'=> $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone_number' => $this->phone,
                'delivery_serv' => ($this->showDelivery) ? 'Нова пошта' : 'Самовивіз',
                'address' => $this->select_city.", ".$this->select_department,
                'comment' => $this->comment,
                'amount' => $summ,
            ]);
            foreach ($orders as $order){
                $order->done=true;
                $order->order_id=$new_id->id;
                $order->save();
            }
        }
        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.order');
    }
}
