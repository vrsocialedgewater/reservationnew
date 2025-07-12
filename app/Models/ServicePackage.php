<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'name', 'price', 'description', 'fixed_price', 'deposit_price'];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
