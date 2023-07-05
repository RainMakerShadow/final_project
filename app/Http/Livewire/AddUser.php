<?php

namespace App\Http\Livewire;

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
        /*dd($this->selected);*/

        $user=User::create();
        $user->name=$this->name;
        $user->email=$this->email;
        $user->password=$this->Hash::make($this->password);
        $user->role=$this->selected;
        $user->created_at=Carbon::now();
        $user->updated_at=Carbon::now();
        $user->save();
/*        User::create([
            'name' =>
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role'=> $this->selected,
        ]);*/
/*        $user->role=$this->selected;
        ;*/
        return redirect()->route('user.show');
    }

    public function render()
    {
        $roles = Role::all();
        return view('users.edit-user', compact('roles'));
    }
}
