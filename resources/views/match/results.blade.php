@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Resultado del Match</h2>

    @if (isset($error))
        <div class="alert alert-warning">
            {{ $error }}
        </div>
    @elseif (isset($bestMatch))
        @php
            $matchData = $bestMatch;
            $percentage = $matchData['percentage'];
        @endphp

        @if ($percentage >= 50)
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">Tu mejor coincidencia: {{ $matchData['psychologist']->name }}</h4>
                    <p class="card-text"><strong>Porcentaje de compatibilidad:</strong> {{ $percentage }}%</p>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Aunque no encontramos una coincidencia fuerte (menos del 50%), aquí algunas razones por las cuales este psicólogo podría ser una opción:
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Razones de compatibilidad:</h5>
                <ul>
                    @foreach ($matchData['reasons'] as $reason)
                        <li>{{ $reason }}</li>
                    @endforeach
                </ul>
                @if (isset($psychologistsRoute) && $psychologistsRoute)
                    <a href="{{ route('psychologists.show', $matchData['psychologist']->id) }}" class="btn btn-primary mt-3">
                        Ver perfil del psicólogo
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

