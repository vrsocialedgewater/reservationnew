<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateSchedule extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'service_id', 'user_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
