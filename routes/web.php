<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\AnswerController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PsychologistController;



// Ruta principal - Catálogo de psicologos
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get("/user", [DashboardController::class, 'index'])->name('User.Dashboard');

 
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get("/user", [DashboardController::class, 'index'])->name('User.Dashboard');

// Rutas de psychologists
Route::get('/psychologists', [PsychologistController::class, 'index'])->name('psychologists.index');
Route::get('/psychologists/search', [PsychologistController::class, 'search'])->name('psychologists.search');
Route::post('/psychologists', [PsychologistController::class, 'store'])->name('psychologists.store');
Route::get('/psychologists/{id}', [PsychologistController::class, 'show'])->name('psychologists.show');
Route::get('/psychologists/{id}/edit', [PsychologistController::class, 'edit'])->name('psychologists.edit');
Route::put('/psychologists/{id}', [PsychologistController::class, 'update'])->name('psychologists.update');



Route::get('/match/results', [MatchController::class, 'showResults'])->name('match.results');

// Ruta para preguntas
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

Route::post('/test/answers', [AnswerController::class, 'store'])->name('answers.store');
