<?php

namespace App\Livewire\Admin\HolidaySchedule;

use App\Models\HolidaySchedule;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{

    public $items;
    public $hideModal = false;

    public function mount(){
        $this->items = HolidaySchedule::latest()->get();
    }


    #[On('holiday_schedule-created')]
    public function createItem($item)
    {
        $newItem = HolidaySchedule::find(@$item['id']);
        $this->items->prepend($newItem);

    }

    #[On('holiday_schedule-updated')]
    public function updateItem($item)
    {
        $this->items = $this->items->map(function ($it) use ($item) {

            if($it->id == @$item['id']){
                $it->name = @$item['name'];
                $it->start_date = @$item['start_date'];
                $it->end_date = @$item['end_date'];
            }

            return $it;
        });
    }


    public function delete($id){
        $item = HolidaySchedule::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('holiday_schedule-deleted', location: $item);

        }

    }
    public function render()
    {
        return view('admin.holiday-schedule.index');
    }
}
