<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisableSchedule extends Model
{
    protected $fillable = ['holiday_schedule_id', 'booking_schedule_id'];

    public function holidaySchedule()
    {
        return $this->belongsTo(HolidaySchedule::class);
    }

    public function bookingSchedule()
    {
        return $this->belongsTo(BookingSchedule::class);
    }
}
