<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional, Laravel auto-infers this)
    protected $table = 'test_results';

    // Fillable fields for mass assignment
    protected $fillable = ['report_id', 'test_name', 'result', 'unit', 'reference_range', 'description'];

    // A test result belongs to a report
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

}
