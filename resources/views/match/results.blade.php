@extends('layouts.app')

@section('title', 'Tus Resultados')

@section('content')
    <div class="container">
        <h1>Tus Resultados</h1>
        
        @if(auth()->check() && $bestMatch)
            <div class="card">
                <div class="card-header">
                    <h2>Tu mejor coincidencia</h2>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $bestMatch['psychologist']->photo_url ?? 'https://via.placeholder.com/200' }}" 
                         alt="{{ $bestMatch['psychologist']->name }}"
                         class="rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                    
                    <h3>{{ $bestMatch['psychologist']->name }}</h3>
                    <p class="match-percentage">{{ $bestMatch['percentage'] }}% de coincidencia</p>
                    
                    <div class="match-reasons">
                        <h4>Por qué es buena opción para ti:</h4>
                        <ul class="text-left">
                            @foreach($bestMatch['reasons'] as $reason)
                                <li>{{ $reason }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    @if($psychologistsRoute)
                        <a href="{{ route('psychologists.show', $bestMatch['psychologist']->id) }}" class="btn btn-primary mt-3">
                            Ver perfil completo
                        </a>
                    @else
                        <a href="/psychologists/{{ $bestMatch['psychologist']->id }}" class="btn btn-primary mt-3">
                            Ver perfil completo
                        </a>
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                @if(!auth()->check())
                    Debes iniciar sesión para ver tus resultados.
                @else
                    No hemos podido encontrar coincidencias. Por favor completa el test nuevamente.
                @endif
            </div>
        @endif
    </div>
@endsection
