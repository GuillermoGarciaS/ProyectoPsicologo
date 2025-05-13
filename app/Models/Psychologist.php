<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'photo_url',
        'specialty',
        'approach',
        'experience',
        'languages',
        'age',
        'studies',
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}