<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminNavigationMenu extends Component
{
    public $ActiveNavLink=false;
    public $ActiveClass="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group";
    public $NotActiveClass="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group";

    public function ToggleActiveClass(){

        if ($this->ActiveNavLink){
            $this->ToggleClass='flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group';
        }
        else{
            $this->ToggleClass='flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
        }
    }
    public function render()
    {
        return view('livewire.admin-navigation-menu');
    }
}
