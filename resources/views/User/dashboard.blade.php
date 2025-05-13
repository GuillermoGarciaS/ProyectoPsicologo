@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1>Mi Perfil</h1>
        <span>
            Miembro desde 
            {{ auth()->check() && auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'N/A' }}
        </span>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        <!-- Columna izquierda -->
        <div>
            <div class="card" style="padding: 20px; margin-bottom: 20px;">
                <h3>Mi Psicólogo Recomendado</h3>
                @if($recommendedPsychologist ?? false)
                    <div style="text-align: center;">
                        <img src="{{ $recommendedPsychologist->photo_url ?? 'https://via.placeholder.com/150' }}" 
                             alt="{{ $recommendedPsychologist->name  }}"
                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; margin: 10px auto;">
                        
                        <h4>{{ $recommendedPsychologist->name }}</h4>
                        <p class="match-percentage">{{ $recommendedPsychologist->match_percentage }}% de coincidencia</p>
                    </div>
                @else
                    <p>Completa el test para encontrar tu psicólogo ideal</p>
                    <a href="{{ route('mbti.test') }}" class="btn btn-primary">Realizar test</a>
                @endif
            </div>
        </div>
        
        <!-- Columna derecha -->
        <div>
            <div class="card" style="padding: 20px; margin-bottom: 20px;">
                <h2>Mis Resultados</h2>
                
                <div style="margin: 20px 0;">
                    <h3>Perfil de Personalidad</h3>
                    <div style="background: #fffaf0; padding: 15px; border-radius: 8px; text-align: center;">
                        @if($user->mbtiResult)
                            <h4 style="color: var(--primary-color);">{{ $user->mbtiResult->type }}</h4>
                            <p>{{ $user->mbtiResult->description ?? 'Descripción no disponible aún.' }}</p>
                        @else
                            <p>No has realizado el test de personalidad aún.</p>
                            <a href="{{ route('mbti.test') }}" class="btn btn-primary">Realizar test</a>
                        @endif

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
