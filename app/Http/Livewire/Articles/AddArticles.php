<?php

namespace App\Http\Livewire\Articles;

use Livewire\Component;

class AddArticles extends Component
{
    public function render()
    {
        return view('articles.add-articles')->layout('layouts.admin');
    }
}
