<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;

class AddMenu extends Component
{




    public function handleBottomBack(){
        return redirect()->route('menu.show');
    }

    public function render()
    {
        return view('menu.add-menu');
    }
}
