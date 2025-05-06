<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::all();
        return view('questions.index', compact('questions'));
    }

    public function store(Request $request) {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_text' => 'required'
        ]);

        Answer::create($request->all());

        return redirect()->back()->with('success', 'Answer submitted successfully.');
    }
}
