<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $locations;
    public $hideModal = false;




    public function mount(){
        $this->locations = Location::latest()->get();
    }

    #[On('location-created')]
    public function createLocation($location)
    {
        $newLocation = Location::find(@$location['id']);
        $this->locations->prepend($newLocation);

    }

    #[On('location-updated')]
    public function updateLocation($location)
    {
        $this->locations = $this->locations->map(function ($loc) use ($location) {

            if($loc->id == $location['id']){
                $loc->name = $location['name'];
                $loc->address = $location['address'];
                $loc->city = $location['city'];
                $loc->state = $location['state'];
                $loc->zip_code = $location['zip_code'];
                $loc->phone_number = $location['phone_number'];
                $loc->image = $location['image'];
            }

            return $loc;
        });
    }


    public function delete($id){
        $item = Location::find($id);

        if ($item) {

            for($i = 0; $i < count($this->locations); $i++){
                if($item->id == $this->locations[$i]['id']){
                    $this->locations->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('location-deleted', location: $item);

        }

    }


    public function render()
    {
        return view('admin.location.index');
    }
}
