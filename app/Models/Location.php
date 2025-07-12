<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'address', 'city', 'state', 'zip_code', 'phone_number', 'image', 'user_id'];


    public function serviceLocations()
    {
        return $this->hasMany(ServiceLocation::class);
    }


}
