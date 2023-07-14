<?php

namespace App\Http\Livewire\Users;

use App\Actions\MyActions\Transliterate;
use App\Actions\MyActions\UpLoadImage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{

    use WithFileUploads;

    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_valid;
    public $role;
    public $selected;
    public $user;
    public $roles;
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
        $user=User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => ($this->password===$this->password_valid)?$this->password_valid: Hash::make($this->password),
            'profile_photo_path' => (is_object($this->image))?$transLiterate['file_name'].'.'.$this->image->getClientOriginalExtension():$user->profile_photo_path,
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
        $this->imageUrl=Storage::url('image/users/'.$this->user->profile_photo_path);

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
