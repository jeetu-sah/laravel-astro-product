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
        User::create([
            'first_name' => 'JS',
            'last_name' => 'Admin',
            'email' => 'jsadmin@gmail.com',
            'email_verified_at' => now(),
            'mobile' => 8887603331,
            'mobile_verified_at' => now(),
            'password' => Hash::make('@Admin@123#'),
            'remember_token' => NULL,
        ]);
    }
}
