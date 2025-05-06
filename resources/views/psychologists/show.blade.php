@extends('layouts.app')

@section('title', $psychologist->name)

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 text-center p-4">
                <img src="{{ $psychologist->photo_url }}" 
                     alt="{{ $psychologist->name }}"
                     class="img-fluid rounded-circle"
                     style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1>{{ $psychologist->name }}</h1>
                    <p class="text-primary h5">{{ $psychologist->specialty }}</p>
                    
                    <div class="mt-4">
                        <p><strong>Enfoque:</strong> {{ $psychologist->approach }}</p>
                        <p><strong>Experiencia:</strong> {{ $psychologist->experience }} años</p>
                        <p><strong>Idiomas:</strong> {{ $psychologist->languages }}</p>
                        <p><strong>Edad:</strong> {{ $psychologist->age }} años</p>
                    </div>
                    
                    <div class="mt-4">
                        <h3>Formación Académica</h3>
                        <p>{{ $psychologist->studies }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <h3>Biografía</h3>
                        <p>{{ $psychologist->bio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection