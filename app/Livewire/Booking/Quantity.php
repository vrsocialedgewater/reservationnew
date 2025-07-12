<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use App\Models\BookingSchedule;
use Illuminate\Support\Facades\Schedule;
use Livewire\Attributes\On;
use Livewire\Component;

class Quantity extends Component
{

    public $items = 1, $schedule_id, $date, $day, $quantity, $start_time, $schedules, $service_id, $slots, $limit = 1, $seats = 1;

    public function mount(){
        $this->getSchedules();
    }

    #[On('set_persons')]
    public function setPersons($persons)
    {
        $this->quantity = $persons;
        $this->items = 1;
        $this->getSchedules();
    }

    #[On('set_date')]
    public function setDate($date)
    {
        $this->date = $date;
        $this->items = 1;
        $this->getSchedules();
    }

    #[On('unset_service')]
    public function unsetService()
    {
        $this->items = 1;
        $this->schedule_id = null;
        $this->day = null;
        $this->date = null;
    }

    #[On('set_service')]
    public function setService($id)
    {
        $this->items = 1;
        $this->service_id = $id;
        $this->getSchedules();
    }

    #[On('set_time')]
    public function setTime($date)
    {
        $this->date = $date;
        $timestamp = strtotime($this->date);
        $this->day = date('l', $timestamp);
        $this->getSchedules();
    }

    public function changeIt($persons){
        if($this->items < 1){
            $this->items = 1;
        } elseif ($this->limit < $this->items){
            $this->items = $this->limit;
        }

//        $this->dispatch('set_items', item: $this->items);
    }

    public function incrementIt(){
        if($this->limit > $this->items){
            $this->items = $this->items + 1;
//            $this->changeIt($this->items);
        }
    }

    public function decrementIt(){
        if($this->items > 1){
            $this->items = $this->items - 1;
//            $this->changeIt($this->items);
        }

    }

    public function render()
    {
        return view('booking.quantity');
    }

    public function getSchedules(){
        $timestamp = strtotime($this->date);
        $this->day = date('l', $timestamp);
        $day = $this->day;
        $date = $this->date;
        $service_id = $this->service_id;
        $this->seats = $this->slots - $this->quantity;
        $seats = $this->seats;
        $this->schedules = BookingSchedule::select('id', 'start_time')
            ->where('start_time', '>=', $this->start_time)
            ->where('service_id', $this->service_id)
            ->whereNull('disabled')
            ->whereHas('day', function ($q) use ($day) {
                $q->where('name', $day);
            })
            ->whereDoesntHave('bookings', function ($r) use ($date, $service_id, $seats) {
                $r->where('date', $date)
                    ->select('booking_schedule_id')
                    ->where('service_id', $service_id)
                    ->whereHas('order', function ($s) {
                        $s->where('status', 'succeeded');
                    })
                    ->groupBy('booking_schedule_id')
                    ->havingRaw('SUM(quantity) > ?', [$seats]);
            })
            ->get();
        $this->limit = $this->schedules->count();
    }
}
