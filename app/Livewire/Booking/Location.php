<?php

namespace App\Livewire\Booking;

use Livewire\Component;

class Location extends Component
{
    public $location;

    public function mount(){
        $this->location = \App\Models\Location::orderBy('id', 'desc')->first();
        $this->dispatch('set_location', id: $this->location->id, location: $this->location);
    }

    public function render()
    {
        return view('booking.location');
    }
}
