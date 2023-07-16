<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ShowUsers extends Component
{
    public $checkedAll='';
    public $toDelete=[];
    public $search;
    public $roles;
    public $users;

    public function mount(){
        $this->users = User::all();
        $this->roles = Role::all();
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
    public function handleInput(){
        $name=$this->search;

        $this->users = User::query()->select()->where('name', 'LIKE', "%{$name}%")->get();

        $this->render();
    }

    //Нужно обработать формирование массива для удаления всех пользователей

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
    $users = $this->users;
    $roles = $this->roles;
        return view('users.show-users', compact('users', 'roles'))->layout('layouts.admin');
    }
}
