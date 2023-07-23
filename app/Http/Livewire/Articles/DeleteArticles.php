<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class DeleteArticles extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=Article::find($id);
            $user->delete();
        }

        return redirect()->route('articles.show');

    }
    public function render()
    {
        return view('articles.delete-articles')->layout('layouts.admin');
    }
}
