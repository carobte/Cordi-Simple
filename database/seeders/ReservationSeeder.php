<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * This method populates the 'reservations' table with predefined reservation data.
     * Each reservation is created with a status, a user ID, and an event ID.
     *
     * @return void
     */

    public function run(): void
    {
        // Create three specific reservations
        
        Reservation::create([
            'status' => true,
            'user_id' => 1, // User ID 1
            'event_id' => 3, // Event ID 1
        ]);

        Reservation::create([
            'status' => true,
            'user_id' => 2, // User ID 2
            'event_id' => 4, // Event ID 2
        ]);

        Reservation::create([
            'status' => true,
            'user_id' => 4, // User ID 3
            'event_id' => 5, // Event ID 3
        ]);
    }
}
