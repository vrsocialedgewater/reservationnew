<?php

namespace App\Livewire\Booking;

use Livewire\Attributes\On;
use Livewire\Component;

class AdditionalService extends Component
{
    public $service_id, $additional_services, $id, $ids = [], $selected_services = [];

    public function mount(){
        $service_id = $this->service_id;
        $this->additional_services = \App\Models\AdditionalService::whereHas('serviceAdditionalServices', function($q) use($service_id) {$q->where('service_id', $service_id);})->orderBy('id', 'desc')->get();
    }

    #[On('set_service')]
    public function setService($id)
    {
        $this->service_id = $id;
        $this->additional_services = \App\Models\AdditionalService::whereHas('serviceAdditionalServices', function($q) use($id) {$q->where('service_id', $id);})->orderBy('id', 'desc')->get();
    }

    #[On('unset_service')]
    public function unsetService()
    {
        $this->service_id = null;
        $this->additional_services = [];
    }

    public function changeId($id, $additional_service){
        $has = false;
        foreach($this->ids as $key => $value){
            if($value == $id){
                unset($this->ids[$key]);
                unset($this->selected_services[$key]);
                $has = true;
                break;
            }
        }
        if(!$has){
            array_push($this->ids, $id);
            array_push($this->selected_services, $additional_service);
        }
        $this->dispatch('set_additional_services', ids: $this->ids, additional_services: $this->selected_services);
    }

    public function render()
    {
        return view('booking.additional-service');
    }
}
