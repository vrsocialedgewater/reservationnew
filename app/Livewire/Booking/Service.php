<?php

namespace App\Livewire\Booking;

use Livewire\Attributes\On;
use Livewire\Component;

class Service extends Component
{
    public $location_id, $service_type_id, $service_type_text, $services, $id, $packages, $service;

    public function mount(){
//        $this->services = \App\Models\Service::whereHas('serviceLocations', function ($q){$q->where('location_id', $this->location_id);})->where('service_type_id', $this->service_type_id)->orderBy('id', 'desc')->get();
        $this->services = \App\Models\Service::where('service_type_id', $this->service_type_id)->with('packages')->orderBy('id', 'desc')->get();
    }

    #[On('set_service_type')]
    public function setServiceType($id, $text)
    {
        $this->service_type_text = $text;
        $this->services = \App\Models\Service::where('service_type_id', $id)->with('packages')->orderBy('id', 'desc')->get();
    }

    public function changeId($id, $text, $price, $slot, $deposit_price, $fixed_price, $service_package_id = null, $service_package_name = null){
        $this->dispatch('unset_service');
        if(!$service_package_id){
            $this->packages = null;
        }
        $service = $this->services->find($id);
        $this->dispatch('set_service', id: $id, text: $text, price: $price, slot: $slot, image: $service->image, fixed_price: $fixed_price, extended_price: $service->extended_price, service_package_id: $service_package_id, service_package_name: $service_package_name, service_deposit_price: $deposit_price);
    }

    public function changeService($id){
        $this->dispatch('unset_service');
        $this->dispatch('unset_package');
        $this->id = null;
        $this->service = $this->services->find($id);
        $this->packages = $this->service->packages;
    }


    public function render()
    {
        return view('booking.service');
    }
}
