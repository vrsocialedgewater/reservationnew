<?php

namespace App\Livewire\Admin\BookingSchedule;

use App\Models\BookingSchedule;
use App\Models\Day;
use App\Models\Service;
use App\Models\ServiceType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{

    use WithFileUploads;
    public $item,$name,$start_time,$end_time,$day_id,$days,$active,$activeService,$service_id;


    protected $rules = [
        'name' => 'required|max:16',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'day_id' => 'required|integer|between:1,9999999',
        'service_id' => 'required|integer|between:1,9999999',
    ];

    public function mount(){
        $this->days = Day::all();
    }
    public function resetFormFields()
    {
        $this->name = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->day_id = '';
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->item = $itemColl;
        $this->name = @$itemColl->name;
        $this->start_time = Carbon::parse(@$itemColl->start_time)->format('H:i');
        $this->end_time = Carbon::parse(@$itemColl->end_time)->format('H:i');
        $this->day_id = @$itemColl->day_id;
    }

    #[On('open-create-form')]
    public function openCreateForm($day_id)
    {
        $this->resetFormFields();
        $this->day_id = $day_id;
    }

    #[On('set_service')]
    public function setService($service, $service_id)
    {
        $this->activeService = $service;
        $this->service_id = $service_id;
    }

    public function store(){
        $validateData = $this->validate();
        try {
            if(@$this->item->id){
                $item = BookingSchedule::find($this->item->id);
                if(!$item){
                    $this->dispatch('booking_schedule-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);

                $this->dispatch('booking_schedule-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $item = BookingSchedule::create($validateData);

            $this->dispatch('booking_schedule-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Booking schedule added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('admin.booking-schedule.form');
    }
}
