<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     * This method is called to populate the database with initial data.
     * It is responsible for invoking the individual seeders for different models.
     *
     * @return void
     */

    public function run(): void
    {
        // You can uncomment the following line to create 10 random users.
        // User::factory(10)->create();

        // Call the EventSeeder to populate events.
        $this->call(EventSeeder::class);

        // Call the RolSeeder to populate roles.
        $this->call(RolSeeder::class);

        // Call the ReservationSeeder to populate reservations.
        $this->call(ReservationSeeder::class);

        // Create a default user with specific attributes.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
