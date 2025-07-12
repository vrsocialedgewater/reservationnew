<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['name', 'email', 'number', 'quantity', 'date', 'location_id', 'service_id', 'booking_schedule_id', 'order_id', 'reminder', 'next_reminder', 'service_package_id'];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function additionalServices()
    {
        return $this->belongsToMany(AdditionalService::class, 'additional_service_bookings', 'booking_id', 'additional_service_id');
    }

//    public function bookingAdditionalServices()
//    {
//        return $this->hasMany(AdditionalServiceBooking::class, 'additional_service_bookings', 'booking_id', 'additional_service_id');
//    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function servicePackage()
    {
        return $this->belongsTo(ServicePackage::class);
    }

    public function bookingSchedule()
    {
        return $this->belongsTo(BookingSchedule::class);
    }

    public function getDateTimeAttribute($value)
    {
        return Carbon::parse($this->date)->format('l d M Y') . ' - ' . Carbon::parse($this->bookingSchedule->start_time)->format('h:i A');
    }

    public function getStartDateTimeAttribute($value)
    {
        return Carbon::parse($this->date)->format('Y-m-d') . 'T' . Carbon::parse($this->bookingSchedule->start_time)->format('H:i:s');
    }

    public function getEndDateTimeAttribute($value)
    {
        return Carbon::parse($this->date)->format('Y-m-d') . 'T' . Carbon::parse($this->bookingSchedule->end_time)->format('H:i:s');
    }

    public function scopeFromCurrentMonth($query)
    {
        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();

        return $query->where('date', '>=', $firstDayOfCurrentMonth);
    }

}
