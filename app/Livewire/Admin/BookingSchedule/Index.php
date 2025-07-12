<?php

namespace App\Livewire\Admin\BookingSchedule;

use App\Models\BookingSchedule;
use App\Models\Day;
use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $items,$activeItem,$services,$activeService;
    public $hideModal = false;

    public function mount(){
        $this->items = Day::with('bookingSchedules')->get();
        $this->selectDay();
        $this->services = Service::select('id', 'title')->orderBy('title', 'asc')->get();
        $this->activeService = $this->services[0];
    }

    public function selectDay($id = null){
        $this->items = $this->items->map(function ($item) use ($id) {
            if($item->id == $id){
                $item->active = true;
                $this->activeItem = $item;
            } elseif (!$id && $item->id == 1){
                $item->active = true;
                $this->activeItem = $item;
            }

            return $item;
        });
    }

    public function setActiveService($value)
    {
        foreach($this->services as $service){
            if($service->id == $value){
                $this->activeService = $service;
            }
        }
        $this->selectDay($this->activeItem->id);
        $this->dispatch('set_service', service: $this->activeService->title,service_id: $this->activeService->id);
    }

    #[On('booking_schedule-created')]
    public function createItem($item)
    {
//        $newItem = BookingSchedule::find(@$item['id']);
        $activeId = $this->activeItem->id;
        $this->items = $this->items->map(function ($it) use ($activeId) {
//            if($it->id == $newItem->day_id){
//                $it->bookingSchedules->prepend($newItem);
//            }
            if($it->id == $activeId){
                $it->active = true;
            }
            return $it;
        });

    }

    #[On('booking_schedule-updated')]
    public function updateItem($item)
    {
        $activeId = $this->activeItem->id;
        $this->items = $this->items->map(function ($it) use ($item, $activeId) {

//            if($it->id == $item['day_id']){
//                $it->bookingSchedules->map(function ($q) use ($it, $item) {
//                    if($q->id == $item['id']){
//                        $q->name = $item['name'];
//                        $q->start_time = $item['start_time'];
//                        $q->end_time = $item['end_time'];
//                        $q->day_id = $item['day_id'];
//                    }
//                    return $q;
//                });
//            }
            if($it->id == $activeId){
                $it->active = true;
            }
            return $it;
        });
    }

    public function delete($id){
        $item = BookingSchedule::find($id);
        if ($item) {

            $activeId = $this->activeItem->id;
            $this->items = $this->items->map(function ($it) use ($item, $activeId) {

//                if($it->id == $item['day_id']){
//                    for($i = 0; $i < count($it->bookingSchedules); $i++){
//                        if($item->id == $it->bookingSchedules[$i]->id){
//                            $it->bookingSchedules->forget($i);
//                        }
//                    }
//                }
                if($it->id == $activeId){
                    $it->active = true;
                }
                return $it;
            });

            $item->delete();
            $this->dispatch('booking_schedule-deleted');

        }

    }

    public function disable($id){
        $item = BookingSchedule::find($id);
        if ($item) {

            $activeId = $this->activeItem->id;
            $this->items = $this->items->map(function ($it) use ($item, $activeId) {

//                if($it->id == $item['day_id']){
//                    for($i = 0; $i < count($it->bookingSchedules); $i++){
//                        if($item->id == $it->bookingSchedules[$i]->id){
//                            $it->bookingSchedules->forget($i);
//                        }
//                    }
//                }
                if($it->id == $activeId){
                    $it->active = true;
                }
                return $it;
            });
            $item->disabled = true;
            $item->save();
            $this->dispatch('booking_schedule-disabled');

        }

    }

    public function enable($id){
        $item = BookingSchedule::find($id);
        if ($item) {

            $activeId = $this->activeItem->id;
            $this->items = $this->items->map(function ($it) use ($item, $activeId) {

//                if($it->id == $item['day_id']){
//                    for($i = 0; $i < count($it->bookingSchedules); $i++){
//                        if($item->id == $it->bookingSchedules[$i]->id){
//                            $it->bookingSchedules->forget($i);
//                        }
//                    }
//                }
                if($it->id == $activeId){
                    $it->active = true;
                }
                return $it;
            });
            $item->disabled = null;
            $item->save();
            $this->dispatch('booking_schedule-enabled');

        }

    }

    public function render()
    {
        return view('admin.booking-schedule.index');
    }
}
