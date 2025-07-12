<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'image', 'price', 'service_type_id', 'user_id', 'slot', 'disabled', 'duration', 'fixed_price', 'extended_price', 'deposit_price'];


    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function serviceAdditionalServices()
    {
        return $this->hasMany(ServiceAdditionalService::class);
    }

    public function packages()
    {
        return $this->hasMany(ServicePackage::class);
    }

    public function additionalServices()
    {
        return $this->belongsToMany(AdditionalService::class, 'service_additional_services');
    }

    public function serviceBookingSchedules()
    {
        return $this->hasMany(ServiceBookingSchedule::class);
    }

    public function serviceHolidaySchedules()
    {
        return $this->hasMany(ServiceHolidaySchedule::class);
    }

    public function serviceLocations()
    {
        return $this->hasMany(ServiceLocation::class);
    }
}
