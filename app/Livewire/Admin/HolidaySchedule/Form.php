<?php

namespace App\Livewire\Admin\HolidaySchedule;

use App\Models\HolidaySchedule;
use App\Models\Service;
use App\Models\BookingSchedule;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{

    public $item,$name,$start_date,$end_date,$services;


    protected $rules = [
        'name' => 'required|max:128',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d'
    ];

    public function mount(){
        $this->services = Service::orderBy("title", "asc")->get();
    }
    public function resetFormFields()
    {
        $this->name = '';
        $this->start_date = '';
        $this->end_date = '';
    }

    #[On('edit-form')]
    public function editForm($item)
    {
        $itemColl = (object) $item;
        $this->resetFormFields();
        $this->item = $itemColl;
        $this->name = @$itemColl->name;
        $this->start_date = Carbon::parse(@$itemColl->start_date)->format('Y-m-d');
        $this->end_date = Carbon::parse(@$itemColl->end_date)->format('Y-m-d');
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
                $item = HolidaySchedule::find($this->item->id);
                if(!$item){
                    $this->dispatch('holiday_schedule-update-error', item: $item);
                    $this->resetFormFields();
                    return false;
                }
                $item->update($validateData);

                $this->dispatch('holiday_schedule-updated', item: $item);
                $this->resetFormFields();
                return $item;
            }
            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $item = HolidaySchedule::create($validateData);

            $this->dispatch('holiday_schedule-created', item: $item);
            $this->resetFormFields();
            session()->flash('form-success', 'Holiday schedule added.');
            return $item;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('admin.holiday-schedule.form');
    }
}
