<form action="{{ route('answers.store') }}" method="POST">
    @csrf
    @foreach ($questions as $question)
        <div class="mb-4">
            <label class="block text-gray-700">{{ $question->question_text }}</label>
            <select name="answers[{{ $question->id }}]" class="w-full p-2 border rounded">
                <option value="Extrovertido">Extrovertido</option>
                <option value="Reservado">Reservado</option>
                <option value="Analítico">Analítico</option>
            </select>
        </div>
    @endforeach
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enviar</button>
</form>