<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Primary Admin Account (Auklet)
        User::updateOrCreate(
            ['email' => 'admin@auklet.sch.id'],
            [
                'name' => 'Andi Pratama',
                'password' => Hash::make('password'),
            ]
        );

        // PPDB Committee Account (Auklet)
        User::updateOrCreate(
            ['email' => 'ppdb@auklet.sch.id'],
            [
                'name' => 'Panitia PPDB',
                'password' => Hash::make('password'),
            ]
        );

        // Legacy compatibility accounts
        User::updateOrCreate(
            ['email' => 'admin@dashcool.sch.id'],
            [
                'name' => 'Administrator Utama',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'spmb@dashcool.sch.id'],
            [
                'name' => 'Panitia SPMB',
                'password' => Hash::make('password'),
            ]
        );
    }
}
