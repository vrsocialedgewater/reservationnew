<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class View extends Component
{
    public $item;
    public function mount($service_id = null){
        $this->item = Service::findOrFail($service_id);
    }

    public function render()
    {
        return view('admin.service.view');
    }
}
