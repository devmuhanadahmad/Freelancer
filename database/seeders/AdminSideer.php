<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSideer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'super',
            'email' =>'super@gmail.com',
            'password' => Hash::make('password'),
            'status'=>'active',
            'super_admin'=>'0'
          ]);
    }
}
