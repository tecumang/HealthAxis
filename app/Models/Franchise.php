<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Franchise extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'lab_name', 'franchise_image','franchise_scanner', 'lab_location', 'owner_name', 'contact', 'email', 'password', 'Status', 'number_of_employees'
    ];

    protected $hidden = [
        'password'
    ];
}
