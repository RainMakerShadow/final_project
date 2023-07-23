<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;

class DeleteNews extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=News::find($id);
            $user->delete();
        }

        return redirect()->route('news.show');

    }
    public function render()
    {
        return view('news.delete-news')->layout('layouts.admin');
    }
}
