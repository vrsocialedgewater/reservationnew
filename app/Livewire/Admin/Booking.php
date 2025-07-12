<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Booking extends Component
{
    public $items, $events = [], $item = [];

    public function mount(){
//        $this->items = \App\Models\Booking::fromCurrentMonth()->with('service', 'order', 'bookingSchedule')->whereHas('order', function ($q) {$q->where('status', 'succeeded');})->latest()->get();

        $this->items = \App\Models\Booking::with('service', 'order', 'bookingSchedule')->whereHas('order', function ($q) {$q->where('status', 'succeeded');})->latest()->get();

        foreach($this->items as $item){
            $this->events[] = [
                'id' => $item->id,
                'title' => $item->name,
                'start' => $item->start_date_time,
                'end' => $item->end_date_time
            ];
        }
    }

    public function updateEvent($eventData)
    {
        $event = Event::find($eventData['id']);
        if ($event) {
            $event->update([
                'start' => $eventData['start'],
                'end' => $eventData['end']
            ]);
            $this->events = Event::all();
        }
    }

    public function setEvent($id)
    {
        foreach($this->items as $item){
            if($item->id == $id){
                $this->item = $item;
            }
        }
    }

    public function render()
    {
        return view('admin.booking');
    }
}
