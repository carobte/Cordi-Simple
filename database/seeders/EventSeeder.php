<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'festival de música',
                'description' => 'un festival de música al aire libre con artistas nacionales e internacionales.',
                'date_start' => '2024-11-10 12:00:00',
                'date_end' => '2024-11-10 23:59:00',
                'location' => 'parque simón bolívar, bogotá',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'feria del libro',
                'description' => 'encuentro literario con escritores y editoriales locales.',
                'date_start' => '2024-10-25 09:00:00',
                'date_end' => '2024-10-29 18:00:00',
                'location' => 'plaza mayor, medellín',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'expo tecnología',
                'description' => 'exposición de avances tecnológicos y nuevas innovaciones.',
                'date_start' => '2024-12-01 10:00:00',
                'date_end' => '2024-12-01 18:00:00',
                'location' => 'corferias, bogotá',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'exposición de arte moderno',
                'description' => 'exposición de obras de arte contemporáneo de artistas colombianos.',
                'date_start' => '2024-11-20 11:00:00',
                'date_end' => '2024-11-20 20:00:00',
                'location' => 'museo de arte moderno, cartagena',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => false,
            ],
            [
                'name' => 'concierto de navidad',
                'description' => 'concierto navideño con coros y orquestas locales.',
                'date_start' => '2024-12-15 19:00:00',
                'date_end' => '2024-12-15 21:00:00',
                'location' => 'teatro metropolitano, medellín',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'festival de cine',
                'description' => 'proyección de películas y charlas con cineastas colombianos.',
                'date_start' => '2024-10-30 14:00:00',
                'date_end' => '2024-11-02 22:00:00',
                'location' => 'cine colombia, cali',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'congreso de medicina',
                'description' => 'encuentro de profesionales de la salud con charlas y talleres.',
                'date_start' => '2024-11-05 08:00:00',
                'date_end' => '2024-11-07 17:00:00',
                'location' => 'hotel hilton, cartagena',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'expo gastronómica',
                'description' => 'muestra de la gastronomía colombiana con degustaciones y talleres.',
                'date_start' => '2024-12-10 10:00:00',
                'date_end' => '2024-12-12 19:00:00',
                'location' => 'centro de convenciones, cali',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => false,
            ],
            [
                'name' => 'festival de danza folclórica',
                'description' => 'presentaciones de grupos de danza folclórica de diferentes regiones.',
                'date_start' => '2024-11-18 15:00:00',
                'date_end' => '2024-11-18 19:00:00',
                'location' => 'plaza mayor, medellín',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
            [
                'name' => 'carrera 10k',
                'description' => 'competencia de atletismo en diferentes categorías.',
                'date_start' => '2024-12-20 07:00:00',
                'date_end' => '2024-12-20 12:00:00',
                'location' => 'parque simón bolívar, bogotá',
                'max_slots' => 250,
                'occupied_slots' => 0,
                'status' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(
                ['name' => $event['name']],
                [
                    'description' => $event['description'],
                    'date_start' => $event['date_start'],
                    'date_end' => $event['date_end'],
                    'location' => $event['location'],
                    'max_slots' => $event['max_slots'],
                    'occupied_slots' => $event['occupied_slots'],
                    'status' => $event['status']
                ]
            );
        }
    }
}
