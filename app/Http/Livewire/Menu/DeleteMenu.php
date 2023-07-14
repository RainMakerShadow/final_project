<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\Menu;

class DeleteMenu extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        //dd($toDelete);
        foreach ($toDelete as $id){
            $menu=Menu::find($id);
            $menu->delete();
        }

        return redirect()->route('menu.show');

    }
    public function render()
    {
        return view('menu.show-menu');
    }
}
