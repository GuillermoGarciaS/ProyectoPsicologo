@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1>Mi Perfil</h1>
        <span>Miembro desde {{ auth()->user()->created_at->format('M Y') }}</span>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        <!-- Columna izquierda -->
        <div>
            <div class="card" style="padding: 20px; margin-bottom: 20px;">
                <h3>Mi Psicólogo Recomendado</h3>
                @if($recommendedPsychologist)
                    <div style="text-align: center;">
                        <img src="{{ $recommendedPsychologist->photo_url ?? 'https://via.placeholder.com/150' }}" 
                             alt="{{ $recommendedPsychologist->name }}"
                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; margin: 10px auto;">
                        
                        <h4>{{ $recommendedPsychologist->name }}</h4>
                        <p class="match-percentage">{{ $recommendedPsychologist->match_percentage }}% de coincidencia</p>
                        
                        <a href="{{ route('psychologists.show', $recommendedPsychologist->id) }}" class="btn">
                            Ver perfil
                        </a>
                    </div>
                @else
                    <p>Completa el test para encontrar tu psicólogo ideal</p>
                    <a href="{{ route('questions.index') }}" class="btn">Realizar test</a>
                @endif
            </div>
        </div>
        
        <!-- Columna derecha -->
        <div>
            <div class="card" style="padding: 20px; margin-bottom: 20px;">
                <h2>Mis Resultados</h2>
                
                <div style="margin: 20px 0;">
                    <h3>Perfil de Personalidad</h3>
                    <div style="background: #f0f0f0; padding: 15px; border-radius: 8px;">
                        <h4 style="color: var(--primary-color);">INFJ</h4>
                        <p>El Consejero - Intuitivo, compasivo y perspicaz.</p>
                    </div>
                </div>
                
                <div style="margin: 20px 0;">
                    <h3>Áreas a Trabajar</h3>
                    <ul>
                        <li>Manejo del estrés</li>
                        <li>Comunicación asertiva</li>
                        <li>Autoconfianza</li>
                    </ul>
                </div>
                
                <a href="{{ route('match.results') }}" class="btn">Ver resultados completos</a>
            </div>
            
            <div class="card" style="padding: 20px;">
                <h3>Historial de Sesiones</h3>
                <p>Próximamente podrás ver tu historial de sesiones aquí.</p>
            </div>
        </div>
    </div>
@endsection