<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['price', 'sub_total', 'fee', 'status', 'partial_payment', 'due_amount'];


    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
