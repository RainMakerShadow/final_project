<?php

namespace App\Http\Livewire\GrapeSort;

use Livewire\Component;
use App\Models\GrapesSort;

class Delete extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $grape=GrapesSort::find($id);
            $grape->delete();
        }

        return redirect()->route('grapes-sort.show');

    }
    public function render()
    {
        return view('livewire.grape-sort.delete');
    }
}
