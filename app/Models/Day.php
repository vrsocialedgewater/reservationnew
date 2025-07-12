<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['name'];

    public function bookingSchedules()
    {
        return $this->hasMany(BookingSchedule::class);
    }
}
