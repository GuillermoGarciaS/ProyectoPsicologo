<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            "¿Cómo te describes en situaciones sociales?",
            "¿Qué haces cuando te sientes estresado/a?",
            "¿Cómo manejas los conflictos?",
            "¿Prefieres trabajar en equipo o solo/a?",
            "¿Cómo reaccionas ante los cambios inesperados?",
            "¿Qué actividad te ayuda a relajarte?",
            "¿Cómo tomas decisiones importantes?",
        ];

        foreach ($questions as $questionText) {
            Question::create([
                'question_text' => $questionText,
            ]);
        }
    }
}