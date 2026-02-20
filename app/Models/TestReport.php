<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    protected $fillable = ['appointment_id', 'report'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}

