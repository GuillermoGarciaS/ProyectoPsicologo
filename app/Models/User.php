<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // paciente, psicólogo o admin
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación con las respuestas del usuario (1 a muchos)
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Relación con el perfil de psicólogo (1 a 1, solo si es psicólogo)
     */
    public function psychologistProfile()
    {
        return $this->hasOne(Psychologist::class);
    }

    /**
     * Relación con las calificaciones dadas (1 a muchos)
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Calcula el porcentaje de coincidencia con un psicólogo específico
     */
    public function matchPercentageWith(Psychologist $psychologist)
    {
        // Verificar si el usuario tiene respuestas
        if (!$this->answers()->exists()) {
            return 0;
        }

        // Obtener respuestas del usuario y del psicólogo
        $userAnswers = $this->answers()->get()->keyBy('question_id');
        $psychAnswers = $psychologist->answers()->get()->keyBy('question_id');
        
        $totalQuestions = $userAnswers->count();
        if ($totalQuestions === 0) return 0;

        $matchScore = 0;
        
        // Calcular coincidencias
        foreach ($userAnswers as $questionId => $userAnswer) {
            if (isset($psychAnswers[$questionId])) {
                $psychAnswer = $psychAnswers[$questionId]->answer_text;
                
                if (is_numeric($userAnswer->answer_text) && is_numeric($psychAnswer)) {
                    // Para respuestas numéricas (escala 1-5)
                    $difference = abs((int)$userAnswer->answer_text - (int)$psychAnswer);
                    $matchScore += (5 - $difference) / 5;
                } else {
                    // Para respuestas textuales
                    similar_text($userAnswer->answer_text, $psychAnswer, $percent);
                    $matchScore += $percent / 100;
                }
            }
        }

        return round(($matchScore / $totalQuestions) * 100);
    }

    /**
     * Verifica si el usuario es psicólogo
     */
    public function isPsychologist()
    {
        return $this->role === 'psychologist';
    }

    /**
     * Verifica si el usuario es paciente
     */
    public function isPatient()
    {
        return $this->role === 'patient';
    }
}