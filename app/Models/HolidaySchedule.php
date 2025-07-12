<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HolidaySchedule extends Model
{

    protected $fillable = ['name', 'start_date', 'end_date', 'user_id', 'disabled'];

    public function serviceHolidaySchedules()
    {
        return $this->hasMany(ServiceHolidaySchedule::class);
    }

    public function disableSchedules()
    {
        return $this->hasMany(DisableSchedule::class);
    }
}
