<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Psychologist;
use Illuminate\Support\Facades\Route;

class MatchController extends Controller
{
    public function showResults()
    {
        $user = auth()->user();

        if (!$user) {
            // Handle the case where the user is not authenticated
            return view('match.results', [
                'error' => 'Debes iniciar sesión para ver tus resultados.'
            ]);
        }

        $bestMatch = $this->calculateBestMatch($user);

        return view('match.results', [
            'bestMatch' => $bestMatch,
            'psychologistsRoute' => Route::has('psychologists.show')
        ]);
    }

    private function calculateBestMatch(User $user)
    {
        if (!$user->answers()->exists()) {
            return null;
        }

        $psychologists = Psychologist::with(['answers'])->get();

        $bestMatch = null;
        $highestPercentage = 0;

        foreach ($psychologists as $psychologist) {
            $currentPercentage = $user->matchPercentageWith($psychologist);
            
            if ($currentPercentage > $highestPercentage) {
                $highestPercentage = $currentPercentage;
                $bestMatch = [
                    'psychologist' => $psychologist,
                    'percentage' => $currentPercentage,
                    'reasons' => $this->getMatchReasons($psychologist)
                ];
            }
        }

        return $bestMatch;
    }

    private function getMatchReasons(Psychologist $psychologist)
    {
        return [
            "Especializado en {$psychologist->specialty}",
            "Enfoque: {$psychologist->approach}",
            "{$psychologist->experience} años de experiencia",
            "Idiomas: {$psychologist->languages}"
        ];
    }
}
