<?php

namespace App\Http\Livewire\NewsCategories;

use App\Models\NewsCategory;
use Livewire\Component;

class DeleteNewsCategories extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=NewsCategory::find($id);
            $user->delete();
        }

        return redirect()->route('news-categories.show');

    }
    public function render()
    {
        return view('news-categories.delete-news-categories')->layout('layouts.admin');
    }
}
