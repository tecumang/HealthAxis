<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'patient_id',
        'franchise_id',
        'test_id',
        'payment_id',
        'appointment_date',
        'status',

    ];

    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function testReport()
    {
        return $this->hasOne(\App\Models\TestReport::class, 'appointment_id', 'appointment_id');
    }

    public function report()
    {
        return $this->hasOne(Report::class, 'appointment_id', 'appointment_id');
    }
}
