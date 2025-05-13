<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    \App\Models\User::firstOrCreate(
        ['email' => 'testuser@psicologia.test'],
        [
            'name' => 'Usuario de Prueba',
            'password' => bcrypt('password123'),
            'role' => 'patient'
        ]
    );
}}