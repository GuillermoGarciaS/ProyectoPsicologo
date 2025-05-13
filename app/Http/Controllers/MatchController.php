<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Psychologist;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function showResults()
    {
        $user = auth()->user();

        if (!$user) {
            return view('match.results', [
                'error' => 'Debes iniciar sesión para ver tus resultados.'
            ]);
        }

        $bestMatch = $this->calculateBestMatch($user);

        if (!$bestMatch) {
            return view('match.results', [
                'error' => 'No hemos podido encontrar coincidencias. Por favor completa el test nuevamente.'
            ]);
        }

        return view('match.results', [
            'bestMatch' => $bestMatch,
            'psychologistsRoute' => Route::has('psychologists.show')
        ]);
    }

    private function calculateBestMatch($user)
    {
        $userMbti = $user->mbti_type;

        if (!$userMbti) {
            return null;
        }

        $psychologists = Psychologist::all();
        $bestMatch = null;
        $highestPercentage = 0;
        $reasons = [];

        foreach ($psychologists as $psychologist) {
            $percentage = $this->calculateFinalMatchPercentage($user, $psychologist);

            if ($percentage > $highestPercentage) {
                $highestPercentage = $percentage;
                $bestMatch = $psychologist;
                $reasons = $this->generateMatchReasons($psychologist, $user);
            }
        }

        if ($bestMatch) {
            return [
                'psychologist' => $bestMatch,
                'percentage' => round($highestPercentage, 2),
                'reasons' => $reasons
            ];
        }

        return null;
    }

    private function calculateMatchPercentage(User $user, Psychologist $psychologist)
    {
        $userAnswers = $user->answers()->pluck('answer_text', 'question_id');
        $psychologistAnswers = $psychologist->answers()->pluck('answer_text', 'question_id');

        $totalQuestions = $userAnswers->count();
        $matchingAnswers = 0;

        foreach ($userAnswers as $questionId => $userAnswer) {
            if (isset($psychologistAnswers[$questionId]) && $userAnswer === $psychologistAnswers[$questionId]) {
                $matchingAnswers++;
            }
        }

        return $totalQuestions > 0 ? ($matchingAnswers / $totalQuestions) * 100 : 0;
    }

    private function calculateMBTICoincidence(User $user, Psychologist $psychologist)
    {
        $userMBTI = $user->mbti_type;
        $psychologistMBTI = $psychologist->mbti_type;

        if ($userMBTI === $psychologistMBTI) {
            return 100;
        }

        // Lógica de coincidencia parcial MBTI (personalizable)
        $similarity = 0;
        for ($i = 0; $i < 4; $i++) {
            if ($userMBTI[$i] === $psychologistMBTI[$i]) {
                $similarity += 25;
            }
        }

        return $similarity; // Resultado entre 0 y 100
    }

    private function calculateFinalMatchPercentage(User $user, Psychologist $psychologist)
    {
        $generalPercentage = $this->calculateMatchPercentage($user, $psychologist);
        $mbtiPercentage = $this->calculateMBTICoincidence($user, $psychologist);

        return ($generalPercentage + $mbtiPercentage) / 2;
    }

    private function generateMatchReasons(Psychologist $psychologist, User $user)
    {
        return [
            "Tu tipo MBTI ({$user->mbti_type}) comparte similitudes importantes con el del psicólogo ({$psychologist->mbti_type}).",
            'El psicólogo tiene experiencia en áreas relacionadas con tu tipo de personalidad.',
            'Tienes un alto nivel de coincidencia en tus respuestas del test de compatibilidad.'
        ];
    }
}
