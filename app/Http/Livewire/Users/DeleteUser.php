<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class DeleteUser extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=User::find($id);
            $user->delete();
        }

        return redirect()->route('user.show');

    }
    public function render()
    {
        return view('users.show-users');
    }
}
