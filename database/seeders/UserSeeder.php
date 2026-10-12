<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@stockify.test'],
            [
                'name' => 'Admin Stockify',
                'password' => 'GantiPassword123!',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@stockify.test'],
            [
                'name' => 'Staff Stockify',
                'password' => 'StaffStockify123!',
                'role' => 'staff',
            ]
        );
    }
}
