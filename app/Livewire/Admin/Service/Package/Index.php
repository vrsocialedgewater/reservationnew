<?php

namespace App\Livewire\Admin\Service\Package;

use App\Models\ServicePackage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{

    public $items;
    public $hideModal = false;




    public function mount(){
        $this->items = ServicePackage::latest()->get();
    }


    #[On('service_package-created')]
    public function createItem($item)
    {
        $newItem = ServicePackage::find(@$item['id']);
        $this->items->prepend($newItem);

    }

    #[On('service_package-updated')]
    public function updateItem($item)
    {
        $this->items = $this->items->map(function ($it) use ($item) {

            if($it->id == $item['id']){
                $it->name = $item['name'];
                $it->description = $item['description'];
                $it->price = $item['price'];
                $it->service_type_id = $item['service_id'];
            }

            return $it;
        });
    }


    public function delete($id){
        $item = ServicePackage::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('service_package-deleted', location: $item);

        }

    }
    public function render()
    {
        return view('admin.service.package.index');
    }
}
