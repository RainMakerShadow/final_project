<?php

namespace App\Http\Livewire\ProductsCategories;

use App\Models\ProductsCategories;
use Livewire\Component;

class DeleteProductsCategories extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=ProductsCategories::find($id);
            $user->delete();
        }

        return redirect()->route('products-categories.show');

    }
    public function render()
    {
        return view('products-categories.show-products-categories');
    }
}
