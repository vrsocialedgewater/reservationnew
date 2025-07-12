<?php

namespace App\Livewire\Admin\StripeCredential;

use App\Models\Service;
use App\Models\StripeCredential;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $items;
    public $hideModal = false;

    public function mount(){
        $this->items = StripeCredential::latest()->get();
    }


    #[On('stripe_credential-created')]
    public function createItem($item)
    {
        $newItem = StripeCredential::find(@$item['id']);
        $this->items->prepend($newItem);

    }

    #[On('stripe_credential-updated')]
    public function updateItem($item)
    {
        $this->items = $this->items->map(function ($it) use ($item) {

            if($it->id == $item['id']){
                $it->name = $item['name'];
                $it->key = $item['key'];
                $it->secret = $item['secret'];
                $it->active = $item['active'];
                $it->user_id = $item['user_id'];
            }

            return $it;
        });
    }


    public function delete($id){
        $item = StripeCredential::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('stripe_credential-deleted', item: $item);

        }

    }
    public function render()
    {
        return view('admin.stripe-credential.index');
    }
}
