<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class RolSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * This method populates the 'rols' table with predefined role data.
     * Each role is created with a name and a description that defines its access level.
     *
     * @return void
     */
    
    public function run(): void
    {

        $rols = [
            [
                'name' => 'administrator',
                'description' => 'User  with full access to the system',
            ],
            [
                'name' => 'general user',
                'description' => 'User  with limited access to the system',
            ]
        ];


        foreach ($rols as $rol) {
            Rol::firstOrCreate(
                ['name' => $rol['name']],
                [
                    'description' => $rol['description'],
                ]
            );
        }
    }
}
