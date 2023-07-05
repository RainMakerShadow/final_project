<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $selected;


    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];
    public function submit()
    {

        $this->validate();
        /*dd($this->selected);*/

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role'=> $this->selected,
        ]);
/*        $user->role=$this->selected;
        $user->save();*/
        return redirect()->route('user.show');
    }

    public function render()
    {
        $roles = Role::all();
        return view('users.edit-user', compact('roles'));
    }
}
