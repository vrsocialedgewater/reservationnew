<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHolidaySchedule extends Model
{

    protected $fillable = ['service_id', 'holiday_schedule_id'];

    public function holidaySchedule()
    {
        return $this->belongsTo(HolidaySchedule::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
