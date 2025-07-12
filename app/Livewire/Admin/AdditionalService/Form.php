<?php

namespace App\Livewire\Admin\AdditionalService;

use App\Models\AdditionalService;
use App\Models\Service;
use App\Models\ServiceAdditionalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $title,$description,$price,$service_ids,$cover_image,$old_cover_image,$image,$item,$services,$options, $selectedServices,$fixed_price,$deposit_price;


    protected $rules = [
        'title' => 'required|min:4|max:256',
        'description' => 'nullable|min:6|max:512',
        'cover_image' => 'nullable|image|max:2048',
        'price' => 'nullable|numeric|between:0.01,9999.99',
        'service_ids.*' => 'required|integer|between:1,9999999',
        'fixed_price' => 'nullable|boolean',
        'deposit_price' => 'nullable|numeric|between:0.01,9999.99',
    ];

    public function mount(){
        $this->services = Service::latest()->get();
        foreach ($this->services as $service) {
            $this->options[] = [
                'id' => $service->id,
                'text' => $service->title
            ];
        }
    }
    public function resetFormFields()
    {
        $this->title = '';
        $this->description = '';
        $this->cover_image = '';
        $this->old_cover_image = '';
        $this->image = '';
        $this->price = null;
        $this->service_ids = [];
        $this->item = null;
        $this->selectedServices = [];
        $this->options = [];
        $this->fixed_price = null;
        $this->deposit_price = null;
        foreach ($this->services as $service) {
            $this->options[] = [
                'id' => $service->id,
                'text' => $service->title
            ];
        }
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->item = $itemColl;
        $this->title = @$itemColl->title;
        $this->description = @$itemColl->description;
        $this->old_cover_image = @$itemColl->image;
        $this->price = @$itemColl->price;
        foreach(@$itemColl->services as $service){
            $this->selectedServices[] = @$service['id'];
        }
        $this->service_ids = $this->selectedServices;
        $this->options = [];
        $this->fixed_price = @$itemColl->fixed_price ? true : null;
        $this->deposit_price = @$itemColl->deposit_price;
        foreach ($this->services as $service) {
            $this->options[] = [
                'id' => $service->id,
                'text' => $service->title,
                "selected" => in_array($service->id, $this->selectedServices)
            ];
        }

        $this->dispatch('change_services_data', data: $this->options);

    }

    #[On('open-create-form')]
    public function openCreateForm()
    {
        $this->resetFormFields();
        $this->dispatch('change_services_data', data: $this->options);
    }

    function remove_cover_image(){
        $this->old_cover_image = '';
    }

    public function store(){
        $validateData = $this->validate();
        $validateData['price'] = $validateData['price'] ? $validateData['price'] : null;
        $validateData['deposit_price'] = $validateData['deposit_price'] ? $validateData['deposit_price'] : null;
        try {

            if ($this->cover_image){
                $filePath = $this->cover_image->store('images/additional_services', 'public');
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
                $item = AdditionalService::find($this->item->id);
                if(!$item){
                    $this->dispatch('additional_service-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);
                $item->services()->sync($this->service_ids);

                $this->dispatch('additional_service-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $item = AdditionalService::create($validateData);
            $item->services()->attach($this->service_ids);

            $this->dispatch('additional_service-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Additional service added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('admin.additional-service.form');
    }
}
