<?php

namespace App\Livewire\Admin\ServiceType;

use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{

    use WithFileUploads;
    public $title,$description,$cover_image,$old_cover_image,$image,$item;


    protected $rules = [
        'title' => 'required|min:4|max:256',
        'description' => 'nullable|min:6|max:512',
        'cover_image' => 'nullable|image|max:2048',
    ];

    public function resetFormFields()
    {
        $this->title = '';
        $this->description = '';
        $this->cover_image = '';
        $this->old_cover_image = '';
        $this->image = '';
        $this->item = null;
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
        try {

            if ($this->cover_image){
                $filePath = $this->cover_image->store('images/service_types', 'public');
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
                $item = ServiceType::find($this->item->id);
                if(!$item){
                    $this->dispatch('service_type-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);

                $this->dispatch('service_type-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $item = ServiceType::create($validateData);

            $this->dispatch('service_type-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Service type added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('admin.service-type.form');
    }
}
