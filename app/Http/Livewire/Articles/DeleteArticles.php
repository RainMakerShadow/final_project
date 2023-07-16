<?php

namespace App\Http\Livewire\Articles;

use Livewire\Component;

class DeleteArticles extends Component
{
    public function render()
    {
        return view('articles.delete-articles')->layout('layouts.admin');
    }
}
