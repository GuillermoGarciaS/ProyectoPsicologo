<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Limpiar tabla primero
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Usuario administrador
        User::create([
            'name' => 'Admin Principal',  
            'email' => 'admin@psicologia.test',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // 2. Usuarios psicólogos
        $psychologists = [
            [
                'name' => 'Dra. Ana López',  
                'email' => 'ana@psicologia.test',
                'password' => Hash::make('password123'),
                'role' => 'psychologist'
            ],
            [
                'name' => 'Dr. Carlos Méndez', 
                'email' => 'carlos@psicologia.test',
                'password' => Hash::make('password123'),
                'role' => 'psychologist'
            ]
        ];

        foreach ($psychologists as $psy) {
            User::firstOrCreate(
                ['email' => $psy['email']],
                $psy
            );
        }

        // 3. Usuarios pacientes (10)
        User::firstOrCreate(
            ['email' => 'default@psicologia.test'],
            [
                'name' => 'Default User',
                'password' => Hash::make('password123'),
                'role' => 'patient'
            ]
        );
        User::factory()->count(10)->create([
            'name' => function() {
                $firstNames = ['Juan', 'María', 'Carlos', 'Laura', 'Pedro'];
                $lastNames = ['Gómez', 'López', 'Martínez', 'García', 'Rodríguez'];
                return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
            },
            'role' => 'patient',
            'password' => Hash::make('password123')
        ]);
    }
}
