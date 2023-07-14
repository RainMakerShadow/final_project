<?php

namespace App\Http\Livewire\Menu;

use App\Models\Menu;
use Livewire\Component;

class ShowMenu extends Component
{
    public $search;
    public $checkedAll='';
    public $toDelete=[];
    public $menu;
    public $order='asc';

    public function mount(){
        $this->menu=Menu::all();
    }

    public function sort ($order){ //сортировка колонок таблицы


        if($this->order==='asc') {
            $this->menu = Menu::query()->orderBy($order, $this->order)->get();
            $this->order='desc';
        }
        elseif($this->order==="desc"){
            $this->menu = Menu::query()->orderByDesc($order)->get();
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

        $this->menu = Menu::query()->select()->where('title', 'LIKE', "%{$title}%")->get();

        $this->render();
    }
    public function render()
    {
        $menu=$this->menu;
        return view('menu.show-menu', compact('menu'));
    }
}
