<?php

namespace App\Livewire\Booking;

use Livewire\Component;

class Checkout extends Component
{
    public $amount;

    public function render()
    {
        return view('booking.checkout');
    }
}
