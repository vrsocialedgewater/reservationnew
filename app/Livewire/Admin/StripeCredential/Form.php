<?php

namespace App\Livewire\Admin\StripeCredential;

use App\Models\StripeCredential;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $name,$key,$secret,$item;
    public $active = false;


    protected $rules = [
        'name' => 'nullable|min:2|max:128',
        'key' => 'required|min:16|max:128',
        'secret' => 'required|min:16|max:128',
        'active' => 'nullable|boolean',
    ];

    public function resetFormFields()
    {
        $this->name = '';
        $this->key = '';
        $this->secret = '';
        $this->active = false;
        $this->item = null;
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->item = $itemColl;
        $this->name = @$itemColl->name;
        $this->key = @$itemColl->key;
        $this->secret = @$itemColl->secret;
        $this->active = @$itemColl->active;
    }

    #[On('open-create-form')]
    public function openCreateForm()
    {
        $this->resetFormFields();
    }

    public function store(){
        $validateData = $this->validate();
        try {

            if(@$this->item->id){
                $item = StripeCredential::find($this->item->id);
                if(!$item){
                    $this->dispatch('stripe_credential-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);

                $this->dispatch('stripe_credential-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $item = StripeCredential::create($validateData);

            $this->dispatch('stripe_credential-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Stripe credential added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.stripe-credential.form');
    }
}
