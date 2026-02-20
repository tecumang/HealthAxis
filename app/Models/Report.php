<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional, Laravel auto-infers this)
    protected $table = 'reports';

    // Fillable fields for mass assignment
    protected $fillable = ['appointment_id', 'report_name', 'description', 'doctore_referral'];

    // A report belongs to an appointment
    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'appointment_id', 'appointment_id');
    }

    // A report has many test results
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}


