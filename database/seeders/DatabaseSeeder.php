<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        $this->command->info('Creating an admin user ...');
        $this->call(UserSeeder::class);

        // Create an event
        $this->command->info('Creating an event ...');
        $this->call(EventSeeder::class);
    }
}
