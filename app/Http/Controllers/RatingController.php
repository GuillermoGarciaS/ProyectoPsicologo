<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request): RedirectResponse 
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'psychologist_id' => 'required|exists:psychologists,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string'
    ]);

    Rating::create($request->all());

    return redirect()->back()->with('success', 'Rating submitted successfully.');
}
}
