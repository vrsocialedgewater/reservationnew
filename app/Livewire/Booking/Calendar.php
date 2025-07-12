<?php

namespace App\Livewire\Booking;

use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $date;

    #[On('set_date')]
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function render()
    {
        return view('booking.calendar');
    }
}
