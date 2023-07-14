<?php

namespace App\Http\Livewire\Menu;

use App\Actions\MyActions\Transliterate;
use App\Models\Menu;
use Livewire\Component;

class EditMenu extends Component
{


    public $menu;
    public $menu_id;
    public $title;
    public $transLiterate;
    public $link;




    public function mount($id){

        $this->menu = Menu::find($id);
        $this->menu_id=$id;
        $this->title=$this->menu->title;
        $this->link=$this->menu->link;

    }

    protected $rules = [
        'title' => 'required',
    ];

    public function handleInputTitle(){

        $this->transLiterate= (new Transliterate)->transLiterate($this->title);
        $this->link='/'.strtolower($this->transLiterate['file_name']);
    }

    public function handleBottomBack(){
        return redirect()->route('menu.show');
    }

    public function submit()
    {

        $this->validate();

        $menu=Menu::find($this->menu_id);

        $menu->update([
            'title' => $this->title,
            'link' => $this->link

        ]);
        $menu->save();
        return redirect()->route('menu.show');
    }

    public function render()
    {
        $menu=$this->menu;
        return view('menu.edit-menu', compact('menu'));
    }
}
