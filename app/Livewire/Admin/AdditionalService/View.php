<?php

namespace App\Livewire\Admin\AdditionalService;

use App\Models\AdditionalService;
use Livewire\Component;

class View extends Component
{
    public $item;

    public function mount($additional_service_id = null){
        $this->item = AdditionalService::with('services')->findOrFail($additional_service_id);
    }

    public function render()
    {
        return view('admin.additional-service.view');
    }
}
