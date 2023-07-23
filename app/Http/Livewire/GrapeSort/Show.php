<?php

namespace App\Http\Livewire\GrapeSort;

use Livewire\Component;
use App\Models\GrapesSort;
class Show extends Component
{

    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $imageUrl;
    public $grapes;

    public $order='asc';

    public function mount(){
        $this->grapes=GrapesSort::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->grapes = GrapesSort::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->grapes = GrapesSort::query()->orderByDesc($order)->get();
            $this->order='asc';
        }

        $this->render();
    }

    public function check($id, $checked){ //обработка действий по клику выбора иформирование массива ID для удаления

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
    public function handleInput(){
        $title=$this->search;

        $this->grapes = GrapesSort::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }
    public function render()
    {
        return view('grapes-sort.show')->layout('layouts.admin');
    }
}
