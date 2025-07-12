<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingSchedule extends Model
{
    protected $fillable = ['name', 'start_time', 'end_time', 'day_id', 'service_id', 'user_id', 'disabled'];

    public function serviceBookingSchedules()
    {
        return $this->hasMany(ServiceBookingSchedule::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function day()
    {
        return $this->BelongsTo(Day::class);
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($this->start_time)->format('h:i A');
    }
    public function getEndDateAttribute($value)
    {
        return Carbon::parse($this->end_time)->format('h:i A');
    }

}
