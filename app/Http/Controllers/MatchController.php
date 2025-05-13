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
            // Si el usuario no está autenticado
            return view('match.results', [
                'error' => 'Debes iniciar sesión para ver tus resultados.'
            ]);
        }

        // Calculamos el mejor match entre el usuario y los psicólogos
        $bestMatch = $this->calculateBestMatch($user);

        // Verificamos si hay un mejor match y en caso de no haberlo, mostramos un mensaje
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

    private function calculateBestMatch(User $user)
    {
        if (!$user->answers()->exists()) {
            return null; // Si el usuario no ha respondido preguntas, no hay coincidencias
        }

        $psychologists = Psychologist::with(['answers'])->get();

        $bestMatch = null;
        $highestPercentage = 0;

        foreach ($psychologists as $psychologist) {
            // Calcular el porcentaje de coincidencia entre el usuario y el psicólogo
            $currentPercentage = $this->calculateFinalMatchPercentage($user, $psychologist);
            
            // Verificar si esta coincidencia es la mejor
            if ($currentPercentage > $highestPercentage) {
                $highestPercentage = $currentPercentage;
                $bestMatch = [
                    'psychologist' => $psychologist,
                    'percentage' => $currentPercentage,
                    'reasons' => $this->generateMatchReasons($psychologist)
                ];
            }
        }

        // Si no hay coincidencias con porcentaje alto, devuelve una coincidencia con los mensajes
        if ($bestMatch && $bestMatch['percentage'] < 50) {
            $bestMatch['percentage'] = null;  // No mostrar el porcentaje si es menor al 50
            $bestMatch['reasons'][] = 'Aunque la coincidencia no es alta, creemos que podrías beneficiarte de este psicólogo.';
        }

        return $bestMatch;
    }

    // Método para calcular el porcentaje de coincidencia basado en las respuestas
    private function calculateMatchPercentage(User $user, Psychologist $psychologist)
    {
        $userAnswers = $user->answers()->pluck('answer_text', 'question_id');
        $psychologistAnswers = $psychologist->answers()->pluck('answer_text', 'question_id');

        $totalQuestions = $userAnswers->count();  // Total de preguntas respondidas
        $matchingAnswers = 0;  // Respuestas coincidentes

        // Comparar las respuestas
        foreach ($userAnswers as $questionId => $userAnswer) {
            if (isset($psychologistAnswers[$questionId]) && $userAnswer === $psychologistAnswers[$questionId]) {
                $matchingAnswers++;
            }
        }

        $percentage = $totalQuestions > 0 ? ($matchingAnswers / $totalQuestions) * 100 : 0;

        return $percentage;
    }

    // Método para calcular la coincidencia del tipo MBTI
    private function calculateMBTICoincidence(User $user, Psychologist $psychologist)
    {
        $userMBTI = $user->mbti_type;
        $psychologistMBTI = $psychologist->mbti_type;

        // Si los tipos MBTI son iguales, la coincidencia es 100%
        if ($userMBTI === $psychologistMBTI) {
            return 100;
        }

        // Si no son iguales, asignamos una coincidencia parcial (ajustar según tus necesidades)
        return 50;  // O alguna lógica para calcular coincidencias parciales
    }

    // Método para combinar las coincidencias generales y MBTI
    private function calculateFinalMatchPercentage(User $user, Psychologist $psychologist)
    {
        // Calcular coincidencia basada en las respuestas
        $generalPercentage = $this->calculateMatchPercentage($user, $psychologist);

        // Calcular coincidencia basada en MBTI
        $mbtiPercentage = $this->calculateMBTICoincidence($user, $psychologist);

        // Promediar los porcentajes de coincidencia (ajustar los pesos según lo que consideres más importante)
        $finalPercentage = ($generalPercentage + $mbtiPercentage) / 2;

        return $finalPercentage;
    }

    // Método para generar razones para la coincidencia
    private function generateMatchReasons(Psychologist $psychologist)
    {
        return [
            'El psicólogo tiene experiencia en tu área de interés.',
            'El enfoque terapéutico del psicólogo es compatible con tu personalidad.',
            'Tienes un alto porcentaje de coincidencia con su enfoque y experiencia.'
        ];
    }
}
