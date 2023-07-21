<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class Order extends Component
{
    public $showDelivery=false;
    public $regions;
    public $cities=[];
    public $select_city;
    public $departments=[];
    public $select_department;
    public $idw;
    private $token = '17e486f71ddefb57d8d56ad5c2058000';
    private $url = 'https://api.novaposhta.ua/v2.0/json/';


    public function mount(){

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


    public function render()
    {
        return view('livewire.order');
    }
}
