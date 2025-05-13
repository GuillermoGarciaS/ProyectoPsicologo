<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\MbtiController;
use App\Http\Controllers\MatchController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


// Dashboard del usuario
Route::get('/user', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

// Catálogo de psicólogos
Route::get('/psychologists', [PsychologistController::class, 'index'])->name('psychologists.index');
Route::get('/psychologists/search', [PsychologistController::class, 'search'])->name('psychologists.search');
Route::post('/psychologists', [PsychologistController::class, 'store'])->name('psychologists.store');
Route::get('/psychologists/{id}', [PsychologistController::class, 'show'])->name('psychologists.show');
Route::get('/psychologists/{id}/edit', [PsychologistController::class, 'edit'])->name('psychologists.edit');
Route::put('/psychologists/{id}', [PsychologistController::class, 'update'])->name('psychologists.update');

// Resultados de compatibilidad
Route::get('/match/results', [MatchController::class, 'showResults'])->name('match.results');

// Test de personalidad (MBTI)
Route::get('/mbti', [MbtiController::class, 'show'])->name('mbti.test');
Route::post('/mbti', [MbtiController::class, 'submit'])->name('mbti.submit');

// Rutas de autenticación
Auth::routes();

// Página de inicio después del login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Terminos, condiciones y política de privacidad
Route::view('/terminos', 'legal.terminos')->name('legal.terminos');
Route::view('/privacidad', 'legal.privacidad')->name('legal.privacidad');
