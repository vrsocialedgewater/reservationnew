<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Livewire\Component;

class View extends Component
{
    public $location;

    public function mount($location_id = null){
        $this->location = Location::findOrFail($location_id);
    }

    public function render()
    {
        return view('admin.location.view');
    }
}
