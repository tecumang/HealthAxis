<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FranchiseSeeder extends Seeder
{
    public function run()
    {
        DB::table('franchises')->insert([
            [
                'lab_name' => 'ABC Diagnostic Center',
                'lab_location' => 'Delhi, India',
                'owner_name' => 'John Doe',
                'contact' => '9876543210',
                'email' => 'abc.lab@example.com',
                'password' => Hash::make('password123'),
                'number_of_employees' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lab_name' => 'XYZ Pathology Lab',
                'lab_location' => 'Mumbai, India',
                'owner_name' => 'Jane Smith',
                'contact' => '8765432109',
                'email' => 'xyz.lab@example.com',
                'password' => Hash::make('password123'),
                'number_of_employees' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

