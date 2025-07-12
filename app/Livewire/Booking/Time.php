<?php

namespace App\Livewire\Booking;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\BookingSchedule;

class Time extends Component
{
    public $schedules, $id, $date, $day, $service_id, $slots, $persons, $quantity;

    public function mount(){
        $timestamp = strtotime($this->date);
        $this->day = date('l', $timestamp);
//        $day = $this->day;
//        $date = $this->date;
//        $service_id = $this->service_id;

//        $this->getSchedules($day, $date, $service_id);
    }

    #[On('set_date')]
    public function setDate($date)
    {
        $this->date = $date;
        $timestamp = strtotime($this->date);
        $this->day = date('l', $timestamp);
        $day = $this->day;
        $service_id = $this->service_id;
//        $this->getSchedules($day, $date, $service_id);
    }

    #[On('set_service')]
    public function setService($id, $text, $price, $slot)
    {
        $day = $this->day;
        $date = $this->date;
        $this->service_id = $id;
        $this->slots = $slot;
//        $this->getSchedules($day, $date, $id);
    }
    #[On('unset_service')]
    public function unsetService()
    {
        $day = null;
        $date = null;
        $this->service_id = null;
        $this->slots = null;
//        $this->getSchedules($day, $date, null);
    }

    #[On('set_persons')]
    public function setPersons($persons)
    {
        $this->quantity = $persons;
    }
    public function changeTime($id, $schedule){
        $this->dispatch('set_schedule', id: $id, schedule: $schedule);
    }

    public function render()
    {
        return view('booking.time');
    }

    private function getSchedules($day, $date, $service_id){
//        $this->schedules = BookingSchedule::where('service_id', $service_id)->whereHas('day', function ($q) use($day){$q->where('name', $day);})->with(['bookings' => function($r) use($date, $service_id){
//            $r->where("date", $date)->where('service_id', $service_id)->whereHas('order', function ($s){$s->where("status", "succeeded");})->with('service');
//        }])->get();
//        logger("here");
//        $this->schedules = BookingSchedule::where('service_id', $service_id)->whereHas('day', function ($q) use($day){$q->where('name', $day);})->with(['bookings' => function($r) use($date, $service_id){
//            $r->selectRaw('booking_schedule_id, sum(quantity) as total_quantity')->where("date", $date)->where('service_id', $service_id)->whereHas('order', function ($s){$s->where("status", "succeeded");})->with('service')->groupBy('booking_schedule_id');
//        }])->get();

    }
}
