<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripeCredential extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'key', 'secret', 'active', 'user_id'];

}
