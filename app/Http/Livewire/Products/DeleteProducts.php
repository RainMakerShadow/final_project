<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class DeleteProducts extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=Product::find($id);
            $user->delete();
        }

        return redirect()->route('products.show');

    }
    public function render()
    {
        return view('products.show-products')->layout('layouts.admin');
    }
}
