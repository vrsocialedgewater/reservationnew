<?php

namespace App\Livewire\Admin\ServiceType;

use Livewire\Component;
use App\Models\ServiceType;

class View extends Component
{
    public $item;
    public function mount($service_type_id = null){
        $this->item = ServiceType::findOrFail($service_type_id);
    }

    public function render()
    {
        return view('admin.service-type.view');
    }
}
