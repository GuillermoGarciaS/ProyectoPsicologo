<?php

namespace App\Http\Controllers;

use App\Models\Psychologist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $recommendedPsychologist = null;
        $matchPercentage = 0;

        if (!$user) {
            // Handle the case where the user is not authenticated
            return view('user.dashboard', [
                'recommendedPsychologist' => null,
                'matchPercentage' => 0,
                'error' => 'Debes iniciar sesión para ver tu perfil.'
            ]);
        }

        if ($user->answers()->exists()) {
            $recommendedPsychologist = Psychologist::with(['answers'])
                ->get()
                ->sortByDesc(function($psychologist) use ($user) {
                    return $user->matchPercentageWith($psychologist);
                })
                ->first();

            if ($recommendedPsychologist) {
                $matchPercentage = $user->matchPercentageWith($recommendedPsychologist);
            }
        }

        return view('user.dashboard', [
            'recommendedPsychologist' => $recommendedPsychologist,
            'matchPercentage' => $matchPercentage
        ]);
    }
}
