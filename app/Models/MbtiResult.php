<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbtiResult extends Model
{
    use HasFactory;

    // Campos que pueden asignarse de forma masiva
    protected $fillable = [
    'user_id',
    'type',
    'description',
];

    /**
     * Relación inversa al usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}