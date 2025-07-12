<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalService extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'description', 'image', 'price', 'user_id', 'fixed_price', 'deposit_price'];

    public function serviceAdditionalServices()
    {
        return $this->hasMany(ServiceAdditionalService::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_additional_services');
    }
}
