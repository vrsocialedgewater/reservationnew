<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{

    use WithFileUploads;
    public $title,$description,$price,$service_type_id,$slot,$cover_image,$old_cover_image,$image,$item,$service_types,$duration,$fixed_price,$deposit_price,$extended_price;


    protected $rules = [
        'title' => 'required|min:4|max:256',
        'description' => 'nullable|min:6|max:512',
        'cover_image' => 'nullable|image|max:2048',
        'price' => 'nullable|numeric|between:0.01,9999.99',
        'service_type_id' => 'required|integer|between:1,9999999',
        'slot' => 'required|integer|between:1,99999',
        'duration' => 'required|integer|between:1,540',
        'fixed_price' => 'nullable|boolean',
        'deposit_price' => 'nullable|numeric|between:0.01,9999.99',
        'extended_price' => 'nullable|numeric|between:0.01,9999.99'
    ];

    public function mount(){
        $this->service_types = ServiceType::latest()->get();
    }
    public function resetFormFields()
    {
        $this->title = '';
        $this->description = '';
        $this->cover_image = '';
        $this->old_cover_image = '';
        $this->image = '';
        $this->price = null;
        $this->service_type_id = null;
        $this->slot = null;
        $this->duration = null;
        $this->item = null;
        $this->fixed_price = null;
        $this->deposit_price = null;
        $this->extended_price = null;
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->item = $itemColl;
        $this->title = @$itemColl->title;
        $this->description = @$itemColl->address;
        $this->old_cover_image = @$itemColl->image;
        $this->price = @$itemColl->price;
        $this->service_type_id = @$itemColl->service_type_id;
        $this->slot = @$itemColl->slot;
        $this->duration = @$itemColl->duration;
        $this->fixed_price = @$itemColl->fixed_price ? true : null;
        $this->deposit_price = @$itemColl->deposit_price;
        $this->extended_price = @$itemColl->extended_price;
    }

    #[On('open-create-form')]
    public function openCreateForm()
    {
        $this->resetFormFields();
    }

    function remove_cover_image(){
        $this->old_cover_image = '';
    }

    public function store(){
        $validateData = $this->validate();
        $validateData['price'] = $validateData['price'] ? $validateData['price'] : null;
        $validateData['deposit_price'] = $validateData['deposit_price'] ? $validateData['deposit_price'] : null;
        $validateData['extended_price'] = $validateData['extended_price'] ? $validateData['extended_price'] : null;
//        $validateData['fixed_price'] = $validateData['fixed_price'] ? 1 : null;
        try {
            if ($this->cover_image){
                $filePath = $this->cover_image->store('images/services', 'public');
                $validateData = array_merge($validateData, [
                    'image' => $filePath,
                ]);
            }
            if(($this->cover_image && @$this->item->image) || (!$this->old_cover_image && @$this->item->image)){
                Storage::disk('public')->delete($this->item->image);
                if((!$this->old_cover_image && @$this->item->image)){
                    $validateData = array_merge($validateData, [
                        'image' => '',
                    ]);
                }
            }


            unset($validateData['cover_image']);
            $this->reset('cover_image');

            if(@$this->item->id){
                $item = Service::find($this->item->id);
                if(!$item){
                    $this->dispatch('service-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);

                $this->dispatch('service-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $item = Service::create($validateData);

            $this->dispatch('service-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Service added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.service.form');
    }
}
