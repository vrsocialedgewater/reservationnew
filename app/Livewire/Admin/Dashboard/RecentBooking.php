<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Booking;
use Livewire\Component;

class RecentBooking extends Component
{
    public $items;

    public function mount(){
        $this->items = Booking::with('service', 'order', 'bookingSchedule')->whereHas('order', function ($q) {$q->where('status', 'succeeded');})->latest()->take(10)->get();
    }
    public function render()
    {
        return view('admin.dashboard.recent-booking');
    }
}
