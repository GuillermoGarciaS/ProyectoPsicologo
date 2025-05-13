<?php

namespace Database\Seeders;

use App\Models\Psychologist;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class PsychologistAnswersSeeder extends Seeder
{
    public function run()
    {
        $questions = Question::all();
        $psychologists = Psychologist::with('user')->get();
    
        foreach ($psychologists as $psychologist) {
            foreach ($questions as $question) {
                Answer::create([
                    'user_id' => $psychologist->user_id, // Usar el user_id del psicólogo
                    'psychologist_id' => $psychologist->id,
                    'question_id' => $question->id,
                    'answer_text' => (string) rand(1, 5)
                ]);
            }
        }
    }
}