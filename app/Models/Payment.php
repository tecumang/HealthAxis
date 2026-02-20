<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'amount',
        'Transaction_id',
        'payment_status',
        'payment_date',
    ];

    public $timestamps = false;

    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'payment_id', 'payment_id');
    }
}
