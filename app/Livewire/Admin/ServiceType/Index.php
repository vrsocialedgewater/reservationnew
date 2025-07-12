<?php

namespace App\Livewire\Admin\ServiceType;

use App\Models\ServiceType;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{

    public $items;
    public $hideModal = false;




    public function mount(){
        $this->items = ServiceType::latest()->get();
    }


    #[On('service_type-created')]
    public function createItem($item)
    {
        $newItem = ServiceType::find(@$item['id']);
        $this->items->prepend($newItem);

    }

    #[On('service_type-updated')]
    public function updateItem($item)
    {
        $this->items = $this->items->map(function ($it) use ($item) {

            if($it->id == $item['id']){
                $it->name = $item['title'];
                $it->address = $item['description'];
                $it->image = $item['image'];
            }

            return $it;
        });
    }


    public function delete($id){
        $item = ServiceType::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('service_type-deleted', location: $item);

        }

    }


    public function render()
    {
        return view('admin.service-type.index');
    }
}
