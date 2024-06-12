<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        $this->command->info('Creating an admin user ...');
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'is_admin' => true, // Add 'is_admin' to the fillable array
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
        ]);
        $this->command->info('Admin user created.');
        
    }
}
