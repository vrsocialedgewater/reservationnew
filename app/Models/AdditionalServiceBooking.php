<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalServiceBooking extends Model
{
    protected $fillable = ['booking_id', 'additional_service_id'];


    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
