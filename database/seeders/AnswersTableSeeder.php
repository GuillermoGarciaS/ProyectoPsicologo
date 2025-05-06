<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $questions = Question::all();

        $possibleAnswers = [
            "Soy muy extrovertido/a",
            "Soy reservado/a pero amigable",
            "Me aíslo y reflexiono",
            "Busco apoyo en amigos",
            "Me enfoco en soluciones prácticas",
        ];

        foreach ($users as $user) {
            foreach ($questions as $question) {
                Answer::create([
                    'user_id' => $user->id,
                    'question_id' => $question->id,
                    'answer_text' => $possibleAnswers[array_rand($possibleAnswers)],
                ]);
            }
        }
    }
}