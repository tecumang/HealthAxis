<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message'
    ];
}
