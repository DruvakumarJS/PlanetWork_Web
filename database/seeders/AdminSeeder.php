<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = User::create([
             'name' => 'SuperAdmin',
             'email' =>'admin@admin.com',
             'password' => Hash::make('admin')
        ]);
    }
}
