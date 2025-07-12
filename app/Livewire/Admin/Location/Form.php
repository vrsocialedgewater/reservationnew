<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    use WithFileUploads;
    public $name,$address,$city,$state,$zip_code,$phone_number,$cover_image,$old_cover_image,$image,$location;


    protected $rules = [
        'name' => 'required|min:4|max:128',
        'address' => 'required|min:6|max:256',
        'city' => 'required|min:4|max:128',
        'state' => 'nullable|min:2|max:128',
        'zip_code' => 'nullable:min:2|max:64',
        'phone_number' => 'nullable|min:6|max:64',
        'cover_image' => 'nullable|image|max:2048',
    ];

    public function resetFormFields()
    {
        $this->name = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';
        $this->zip_code = '';
        $this->phone_number = '';
        $this->cover_image = '';
        $this->old_cover_image = '';
        $this->image = '';
        $this->location = null;
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->location = $itemColl;
        $this->name = @$itemColl->name;
        $this->address = @$itemColl->address;
        $this->city = @$itemColl->city;
        $this->state = @$itemColl->state;
        $this->zip_code = @$itemColl->zip_code;
        $this->phone_number = @$itemColl->phone_number;
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
                $filePath = $this->cover_image->store('images/locations', 'public');
                $validateData = array_merge($validateData, [
                    'image' => $filePath,
                ]);
            }
            if(($this->cover_image && @$this->location->image) || (!$this->old_cover_image && @$this->location->image)){
                Storage::disk('public')->delete($this->location->image);
                if((!$this->old_cover_image && @$this->location->image)){
                    $validateData = array_merge($validateData, [
                        'image' => '',
                    ]);
                }
            }


            unset($validateData['cover_image']);
            $this->reset('cover_image');

            if(@$this->location->id){
                $location = Location::find($this->location->id);
                if(!$location){
                    $this->dispatch('location-update-error', location: $location);
                    $this->resetFormFields();
                    return false;
                }
                $location->update($validateData);

                $this->dispatch('location-updated', location: $location);
                $this->resetFormFields();
                return $location;
            }

            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $location = Location::create($validateData);

            $this->dispatch('location-created', location: $location);
            $this->resetFormFields();
            session()->flash('form-success', 'Location added.');
            return $location;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }




    public function render()
    {
        return view('admin.location.form');
    }
}
