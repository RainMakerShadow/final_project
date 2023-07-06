<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
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
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role'=> $this->selected,
        ]);
/*
        $user=User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => ($this->password===$this->password_valid)?$this->password_valid: Hash::make($this->password),
        ]);
        $user->role=$this->selected;
        $user->save();
        $user->save()
        $user->role=$this->selected;*/

        return redirect()->route('user.show');
    }

    public function render()
    {
        $roles = Role::all();
        return view('users.edit-user', compact('roles'));
    }
}
