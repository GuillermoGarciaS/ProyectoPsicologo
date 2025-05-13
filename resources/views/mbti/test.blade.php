<!-- resources/views/mbti/test.blade.php -->
@extends('layouts.app')

@section('title', 'Test de Personalidad MBTI')

@section('content')
    <h1>Test de Personalidad</h1>
    <form method="POST" action="{{ route('mbti.submit') }}">
        @csrf

        @foreach ($questions as $question)
            <div class="card" style="padding: 15px; margin: 15px 0;">
                <p><strong>{{ $question->text }}</strong></p>
                <label>
                    <input type="radio" name="answers[{{ $question->id }}]" value="A" required> {{ $question->option_a }}
                </label><br>
                <label>
                    <input type="radio" name="answers[{{ $question->id }}]" value="B" required> {{ $question->option_b }}
                </label>
            </div>
        @endforeach

        <button class="btn btn-primary" type="submit">Enviar</button>
    </form>
@endsection