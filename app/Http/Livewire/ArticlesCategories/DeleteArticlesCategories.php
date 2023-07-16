<?php

namespace App\Http\Livewire\ArticlesCategories;

use App\Models\ArticleCategory;
use Livewire\Component;

class DeleteArticlesCategories extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=ArticleCategory::find($id);
            $user->delete();
        }

        return redirect()->route('articles-categories.show');

    }
    public function render()
    {
        return view('articles-categories.delete-articles-categories')->layout('layouts.admin');
    }
}
