<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ShowUsers extends Component
{
    public $checkedAll='';
    public $toDelete=[];

    public function check($id, $checked){ //обработка действий по клику выбора пользователя и формируется массив ID пользователей для удаления

        if($checked==true){
            array_push($this->toDelete, $id);
        }
        else{
            $key = array_search($id, $this->toDelete);
                unset($this->toDelete[$key]);
        }
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
    $users = User::all();
    $roles = Role::all();
        return view('users.show-users', compact('users', 'roles'));
    }
}
