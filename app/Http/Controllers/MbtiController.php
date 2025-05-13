<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MbtiResult;
use App\Models\Question;

class MbtiController extends Controller
{
    // Show the MBTI test form
    public function show(Request $request)
    {
        $questions = Question::all();
        $total = $questions->count();

        return view('mbti.test', [
            'questions' => $questions,
            'total' => $total,
        ]);
    }

    // Submit the MBTI test results
    public function submit(Request $request)
    {
        $user = Auth::user();
        $answers = $request->input('answers');

        // Calculate the MBTI based on the answers
        $mbti = $this->calculateMbtiFromAnswers($answers);

        // Save or update the MBTI result in the database
        MbtiResult::updateOrCreate(
            ['user_id' => $user->id],
            ['type' => $mbti, 'description' => 'Descripción opcional para el tipo '.$mbti]
        );

        return redirect()->route('user.profile')->with('success', 'Resultado guardado');
    }

    
    private function calculateMbtiFromAnswers($answers)
{
    $scores = [
        'EI' => 0,
        'SN' => 0,
        'TF' => 0,
        'JP' => 0,
    ];

    foreach ($answers as $questionId => $selectedOption) {
        $question = \App\Models\Question::find($questionId);
        if (!$question || !isset($scores[$question->dimension])) {
            continue;
        }

        // Opción A suma puntos al primer rasgo (por ejemplo, E en EI)
        if ($selectedOption === 'A') {
            $scores[$question->dimension]++;
        }
    }

    $mbti = '';
    $mbti .= $scores['EI'] >= 1 ? 'E' : 'I';
    $mbti .= $scores['SN'] >= 1 ? 'S' : 'N';
    $mbti .= $scores['TF'] >= 1 ? 'T' : 'F';
    $mbti .= $scores['JP'] >= 1 ? 'J' : 'P';

    return $mbti;
}


}
