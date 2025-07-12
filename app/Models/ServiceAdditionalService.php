<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAdditionalService extends Model
{
    protected $fillable = ['additional_service_id', 'service_id'];


    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function additionalServices()
    {
        return $this->belongsTo(AdditionalService::class);
    }
}
