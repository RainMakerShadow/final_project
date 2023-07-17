<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Index extends Component
{
    public $currentPage;

    public function setCurrentPage($page)
    {
        $this->currentPage = $page;

        $breadcrumbs = [
            ['title' => 'Home', 'url' => '/'],
            ['title' => 'Main Page', 'url' => '/main'],
            ['title' => $page, 'url' => '/main/' . $page],
        ];

        $this->emit('updateBreadcrumbs', $breadcrumbs);
    }
    public function render()
    {
        return view('livewire.index');
    }
}
