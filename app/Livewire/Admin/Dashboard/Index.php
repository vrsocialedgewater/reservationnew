<?php

namespace App\Livewire\Admin\Dashboard;

use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('admin.dashboard.index');
    }
}
