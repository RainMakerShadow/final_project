<?php

namespace App\Http\Livewire\Users;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class AddUser extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $selected;
    public $image;
    public $imageUrl;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function handleBottomBack(){
        return redirect()->route('user.show');
    }

    public function submit()
    {

        $this->validate();
        $transLiterate= (new Transliterate)->transLiterate($this->name);
        if(is_object($this->image)){
            $this->validate([
                'image' => 'required|file|max:4096',
            ]);
            (new UpLoadImage)->UpLoadImage('public/image/users', $transLiterate['file_name'], $this->image);
        }
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role'=> $this->selected,
            'profile_photo_path' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$user->profile_photo_path,
        ]);

        return redirect()->route('user.show');
    }

    public function render()
    {
        $roles = Role::all();
        return view('users.edit-user', compact('roles'))->layout('layouts.admin');
    }
}
