<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            QuestionsTableSeeder::class,
            PsychologistsTableSeeder::class,
            PsychologistAnswersSeeder::class,
            AnswersTableSeeder::class,
            TestUserSeeder::class
        ]);
    }
}