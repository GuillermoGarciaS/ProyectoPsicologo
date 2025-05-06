<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\User;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required'
    ]);

    // Obtener usuario autenticado o crear uno de prueba
    $user = auth()->user() ?? User::firstOrCreate(
        ['email' => 'testuser@psicologia.test'],
        [
            'name' => 'Usuario de Prueba',
            'password' => bcrypt('password123'),
            'role' => 'patient'
        ]
    );

    // Eliminar respuestas anteriores del usuario
    Answer::where('user_id', $user->id)->delete();

    // Guardar nuevas respuestas
    foreach ($request->answers as $questionId => $answerValue) {
        Answer::create([
            'user_id' => $user->id, 
            'question_id' => $questionId,
            'answer_text' => $answerValue
        ]);
    }

    return redirect()->route('match.results');
}}
