<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::insert([
            ['name' => 'Music Concert', 'venue' => 'Stadium A', 'event_date' => '2024-12-10', 'total_seats' => 500, 'available_seats' => 500, 'ticket_price' => 100.00, 'created_at' => now()],
            ['name' => 'Tech Conference', 'venue' => 'Hall B', 'event_date' => '2024-11-20', 'total_seats' => 300, 'available_seats' => 300, 'ticket_price' => 50.00, 'created_at' => now()],
            ['name' => 'Art Exhibition', 'venue' => 'Gallery C', 'event_date' => '2024-10-15', 'total_seats' => 200, 'available_seats' => 200, 'ticket_price' => 30.00, 'created_at' => now()]
        ]);
    }
}
