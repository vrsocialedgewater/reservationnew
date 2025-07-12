<?php

namespace App\Livewire\Admin\GenerateSchedule;

use App\Models\GenerateSchedule;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $items;
    public $hideModal = false;


    public function mount(){
        $this->items = GenerateSchedule::with('service')->latest()->get();
    }

    #[On('schedule-generated')]
    public function generateSchedule($schedule_generate)
    {
        $newItem = GenerateSchedule::find(@$schedule_generate['id']);
        $this->items->prepend($newItem);

    }


    public function delete($id){
        $item = GenerateSchedule::find($id);

        if ($item) {

            for($i = 0; $i < count($this->items); $i++){
                if($item->id == $this->items[$i]['id']){
                    $this->items->forget($i);
                }
            }
            $item->delete();
            $this->dispatch('schedule-generate-deleted', generate_schedule: $item);

        }

    }
    public function render()
    {
        return view('admin.generate-schedule.index');
    }
}
