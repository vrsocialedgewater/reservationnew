<?php

namespace App\Livewire\Booking;

use Livewire\Component;

class ServiceType extends Component
{
    public $serviceTypes, $id;

    public function mount(){
        $this->serviceTypes = \App\Models\ServiceType::all();
    }

    public function changeId($id, $text){
        $this->dispatch('unset_service');
        $this->dispatch('set_service_type', id: $id, text: $text);
    }

    public function render()
    {
        return view('booking.service-type');
    }
}
