<?php

namespace App\Livewire\Admin\Service\Package;

use App\Models\Service;
use App\Models\ServicePackage;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $name,$price,$description,$service_id,$services,$item,$fixed_price,$deposit_price;


    protected $rules = [
        'name' => 'required|min:3|max:256',
        'description' => 'nullable|min:6|max:512',
        'price' => 'nullable|numeric|between:0.01,9999.99',
        'service_id' => 'required|integer|between:1,9999999',
        'fixed_price' => 'nullable|boolean',
        'deposit_price' => 'nullable|numeric|between:0.01,9999.99',
    ];

    public function mount(){
        $this->services = Service::latest()->get();
    }
    public function resetFormFields()
    {
        $this->name = '';
        $this->price = null;
        $this->description = null;
        $this->service_id = null;
        $this->fixed_price = null;
        $this->deposit_price = null;
        $this->item = null;
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->item = $itemColl;
        $this->name = @$itemColl->name;
        $this->price = @$itemColl->price;
        $this->description = @$itemColl->description;
        $this->service_id = @$itemColl->service_id;
        $this->fixed_price = @$itemColl->fixed_price ? true : null;
        $this->deposit_price = @$itemColl->deposit_price;
    }

    #[On('open-create-form')]
    public function openCreateForm()
    {
        $this->resetFormFields();
    }


    public function store(){
        $validateData = $this->validate();
        $validateData['price'] = $validateData['price'] ? $validateData['price'] : null;
        $validateData['deposit_price'] = $validateData['deposit_price'] ? $validateData['deposit_price'] : null;
        try {
            if(@$this->item->id){
                $item = ServicePackage::find($this->item->id);
                if(!$item){
                    $this->dispatch('service_package-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);

                $this->dispatch('service_package-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $item = ServicePackage::create($validateData);

            $this->dispatch('service_package-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Service package added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.service.package.form');
    }
}
