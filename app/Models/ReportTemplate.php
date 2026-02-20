<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    protected $fillable = ['franchise_id', 'header_image', 'footer_image'];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }
}
