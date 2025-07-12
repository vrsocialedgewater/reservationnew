<?php

namespace App\Livewire\Booking;

use Livewire\Attributes\On;
use Livewire\Component;

class Navigate extends Component
{

    public $checkout = false;

    #[On('set_checkout')]
    public function setCheckout($checkout)
    {
        $this->checkout = $checkout;
    }

    public function checkoutOff()
    {
        $this->checkout = false;
        $this->dispatch('set_checkout', checkout: false);
    }

    public function render()
    {
        return view('booking.navigate');
    }
}
