<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $items;
    public $hideModal = false;




    public function mount(){
        $this->items = Service::latest()->get();
    }


    #[On('service-created')]
    public function createItem($item)
    {
        $newItem = Service::find(@$item['id']);
        $this->items->prepend($newItem);

    }

    #[On('service-updated')]
    public function updateItem($item)
    {
        $this->items = $this->items->map(function ($it) use ($item) {

            if($it->id == $item['id']){
                $it->name = $item['title'];
                $it->description = $item['description'];
                $it->image = $item['image'];
                $it->price = $item['price'];
                $it->service_type_id = $item['service_type_id'];
                $it->slot = $item['slot'];
                $it->duration = $item['duration'];
            }

            return $it;
        });
    }


    public function delete($id){
        $item = Service::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('service-deleted', location: $item);

        }

    }

    public function render()
    {
        return view('admin.service.index');
    }
}
