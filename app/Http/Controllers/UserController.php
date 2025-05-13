<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MbtiResult;
use App\Models\Psychologist;

class UserController extends Controller
{
    public function dashboard()
{
    $user = Auth::user()->load('mbtiResult');
    $recommendedPsychologist = $this->getRecommendedPsychologist($user);

    return view('user.Dashboard', compact('user', 'recommendedPsychologist'));
}

private function getRecommendedPsychologist($user)
{
    $mbti = $user->mbtiResult->type ?? null;

    if (!$mbti) return null;

    return Psychologist::where('specialty', 'LIKE', '%' . $mbti . '%')->first();
}

public function profile()
{
    $user = Auth::user();

    $user->load('mbtiResult');

    // MODIFICAR EN UN MOMENTO
    $recommendedPsychologist = null;

    return view('user.dashboard', compact('user', 'recommendedPsychologist'));
}


}
