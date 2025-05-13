@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Test de Personalidad</h1>
        
        <div class="mb-6 bg-blue-50 p-4 rounded-lg">
            <p class="text-blue-800">Por favor responde con sinceridad a las siguientes preguntas. Esto nos ayudará a recomendarte el psicólogo más adecuado para tus necesidades.</p>
            <p class="text-blue-800 mt-2">Progreso: <span id="progress">1</span>/{{ count($questions) }}</p>
        </div>

        <form id="personalityTest" action="{{ route('answers.store') }}" method="POST">
            @csrf
            
            <div id="questionsContainer">
                @foreach($questions as $index => $question)
                <div class="question mb-8 {{ $index !== 0 ? 'hidden' : '' }}" data-index="{{ $index }}">
                    <h3 class="text-lg font-medium mb-4">{{ $question->question_text }}</h3>
                    
                    <div class="space-y-3">
                        @foreach($questions as $index => $question)
                            <div class="question mb-8 {{ $index !== 0 ? 'hidden' : '' }}" data-index="{{ $index }}">
                                <h3 class="text-lg font-medium mb-4">{{ $question->question_text }}</h3>

                                <div class="space-y-3">
                                    @foreach(['Totalmente en desacuerdo', 'En desacuerdo', 'Neutral', 'De acuerdo', 'Totalmente de acuerdo'] as $i => $option)
                                        <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i + 1 }}" class="h-4 w-4 text-indigo-600" required>
                                            <span>{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                    @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" id="prevBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 hidden">Anterior</button>
                <button type="button" id="nextBtn" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Siguiente</button>
                <button type="submit" id="submitBtn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 hidden">Enviar Test</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questions = document.querySelectorAll('.question');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const progress = document.getElementById('progress');
        let currentQuestion = 0;

        function showQuestion(index) {
            questions.forEach((q, i) => {
                q.classList.toggle('hidden', i !== index);
            });
            
            prevBtn.classList.toggle('hidden', index === 0);
            nextBtn.classList.toggle('hidden', index === questions.length - 1);
            submitBtn.classList.toggle('hidden', index !== questions.length - 1);
            
            progress.textContent = index + 1;
        }

        nextBtn.addEventListener('click', function() {
            if (document.querySelector(`.question[data-index="${currentQuestion}"] input:checked`)) {
                currentQuestion++;
                showQuestion(currentQuestion);
            } else {
                alert('Por favor selecciona una respuesta');
            }
        });

        prevBtn.addEventListener('click', function() {
            currentQuestion--;
            showQuestion(currentQuestion);
        });
    });
</script>
@endsection
