<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Breadcrumbs extends Component
{
    public $breadcrumbs = [];

    protected $listeners = ['updateBreadcrumbs'];

    public function updateBreadcrumbs($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function render()
    {
        return view('livewire.breadcrumbs');
    }
}
