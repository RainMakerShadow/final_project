<?php

namespace App\Http\Livewire\Menu;

use App\Actions\MyActions\Transliterate;
use App\Models\Menu;
use Livewire\Component;

class AddMenu extends Component
{


    public $menu;
    public $title;
    public $transLiterate;
    public $link;


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

        Menu::create([
            'title' => $this->title,
            'link' => $this->link
        ]);

        return redirect()->route('menu.show');
    }

    public function render()
    {
        return view('menu.add-menu');
    }
}
