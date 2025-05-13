@foreach ($matchedPsychologists as $psychologist)
    <div class="p-4 border-b">
        <h3 class="font-bold">{{ $psychologist->name }}</h3>
        <p>Coincidencia: {{ $psychologist->match_score }}%</p>
    </div>
@endforeach