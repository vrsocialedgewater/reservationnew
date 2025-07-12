<?php

namespace App\Livewire\Booking;

use Livewire\Attributes\On;
use Livewire\Component;

class Person extends Component
{
    public $persons = 0, $slots;
    public function changePersons($persons){
        if($this->persons < 1){
            $this->persons = 1;
        } elseif ($this->slots < $this->persons){
            $this->persons = $this->slots;
        }

        $this->dispatch('set_persons', persons: $this->persons);
    }

    public function increment(){
        if($this->slots > $this->persons){
            $this->persons = $this->persons + 1;
            $this->changePersons($this->persons);
        }
    }

    public function decrement(){
        if($this->persons > 1){
            $this->persons = $this->persons - 1;
            $this->changePersons($this->persons);
        }

    }

    #[On('set_service')]
    public function setService($id, $text, $price, $slot)
    {
        $this->slots = $slot;
        if($this->persons < 1){
            $this->persons = 1;
        } elseif ($this->slots < $this->persons){
            $this->persons = $this->slots;
        }
    }

    #[On('unset_service')]
    public function unsetService()
    {
        $this->slots = null;
        $this->persons = null;
    }

    public function render()
    {
        return view('booking.person');
    }
}
