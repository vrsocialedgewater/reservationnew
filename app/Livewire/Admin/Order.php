<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Order extends Component
{

    public $items;

    public function mount(){
        $this->items = \App\Models\Order::with('booking.service',)->latest()->get();
    }

    public function render()
    {
        return view('admin.order');
    }
}
