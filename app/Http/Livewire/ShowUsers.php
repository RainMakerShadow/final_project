<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ShowUsers extends Component
{
    public function render()
    {
    $users = User::all();
        return view('users.show-users', compact('users'));
    }
}
