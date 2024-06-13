<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Enums\EventStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'Example Event 1',
            'description' => 'Description of event',
            'start_date' => '2024-06-12 21:03:07',
            'end_date' => '2024-06-12 21:03:07',
            'latitude' => 47.635,
            'longitude' => 6.847,
            'radius' => 30,
            'event_status' => EventStatus::NOT_STARTED,
        ]);
        Event::create([
            'title' => 'Example Event 2',
            'description' => 'Description of event',
            'start_date' => '2024-06-12 21:03:07',
            'end_date' => '2024-06-12 21:03:07',
            'latitude' => 47.634,
            'longitude' => 6.848,
            'radius' => 30,
            'event_status' => EventStatus::NOT_STARTED,
        ]);
    }
}
