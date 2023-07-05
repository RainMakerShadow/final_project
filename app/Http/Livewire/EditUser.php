<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_valid;
    public $role;
    public $selected;
    public $user;
    public $roles;


    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function submit()
    {

        $this->validate();
        /*dd($this->selected);*/

        $user=User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => ($this->password===$this->password_valid)?$this->password_valid: Hash::make($this->password),
        ]);
        $user->role=$this->selected;
        $user->save();
        return redirect()->route('user.show');
    }
    public function mount($id)
    {
        $this->userId = $id;

        $this->user = User::find($this->userId);
        $this->name=$this->user->name;
        $this->password=$this->user->password;
        $this->password_valid=$this->user->password;
        $this->email=$this->user->email;
        $this->selected=$this->user->role;

        $this->roles = Role::all();
    }
    public function render()
    {
/*        $id=$this->userId;
        $user=User::query()
            ->join('roles',function ($join) use ($id){
                $join
                    ->on('users.role', '=', 'roles.id')
                    ->where('users.id', $id);
            })
            ->select('users.*', 'roles.name')
            ->get();
        echo('<pre>');
        print_r($user);
        echo('<pre/>');
        die();*/
        /*$user = User::query()->select()->where('id', $this->userId)->get()->toArray();*/
        $user = $this->user;

        $roles = $this->roles;


        return view('users.edit-user', compact('user', 'roles'));
    }
}
