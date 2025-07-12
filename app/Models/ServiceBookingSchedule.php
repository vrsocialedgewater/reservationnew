<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBookingSchedule extends Model
{
    protected $fillable = ['service_id', 'booking_schedule_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookingSchedule()
    {
        return $this->belongsTo(BookingSchedule::class);
    }

}
