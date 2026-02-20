<?php

namespace App\Models;

use App\Models\Franchise;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $primaryKey = 'test_id';

    protected $fillable = [
        'franchise_id',
        'test_name',
        'test_description',
        'price',
        'home_collection'
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function franchiseDetails()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }
}
