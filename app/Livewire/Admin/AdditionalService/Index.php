<?php

namespace App\Livewire\Admin\AdditionalService;

use App\Models\AdditionalService;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $items;
    public $hideModal = false;

    public function mount(){
        $this->items = AdditionalService::with('services')->latest()->get();
    }


    #[On('additional_service-created')]
    public function createItem($item)
    {
        $newItem = AdditionalService::with('services')->find(@$item['id']);
        $this->items->prepend($newItem);

    }

    #[On('additional_service-updated')]
    public function updateItem($item)
    {
        $this->items = AdditionalService::with('services')->latest()->get();
    }

    public function delete($id){
        $item = AdditionalService::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('additional_service-deleted', location: $item);

        }

    }
    public function render()
    {
        return view('admin.additional-service.index');
    }
}
