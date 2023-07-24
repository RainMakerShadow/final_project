<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class Delete extends Component
{
    public function mount($toDelete){
        $toDelete=explode(',',$toDelete);
        foreach ($toDelete as $id){
            $user=Order::find($id);
            $user->delete();
        }

        return redirect()->route('orders');

    }
    public function render()
    {
        return view('livewire.orders.delete');
    }
}
