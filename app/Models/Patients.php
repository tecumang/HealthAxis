<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patients extends Authenticatable
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'name', 'address', 'city', 'date_of_birth', 'gender', 'contact', 'email', 'password', 
    ];

    protected $hidden = ['password'];
}
