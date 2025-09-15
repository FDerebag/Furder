<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@furder.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        echo "Admin user created!\n";
        echo "Email: admin@furder.com\n";
        echo "Password: admin123\n";
    }
}
