@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Directorio de Psicólogos</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('psychologists.search') }}" class="row g-3 mb-5 justify-content-center">
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}" />
        </div>
        <div class="col-md-4">
            <input type="text" name="specialty" class="form-control" placeholder="Buscar por especialidad" value="{{ request('specialty') }}" />
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <div class="card mb-5 shadow-sm">
        <div class="card-header">
            <h5>Añadir Psicólogo</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('psychologists.store') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Aquí van los campos del formulario -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required />
                </div>
                <div class="mb-3">
                    <label for="photo_url" class="form-label">URL de la Foto</label>
                    <input type="url" class="form-control" id="photo_url" name="photo_url" />
                </div>
                <div class="mb-3">
                    <label for="specialty" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" id="specialty" name="specialty" />
                </div>
                <div class="mb-3">
                    <label for="experience" class="form-label">Años de Experiencia</label>
                    <input type="number" class="form-control" id="experience" name="experience" min="0" />
                </div>
                <div class="mb-3">
                    <label for="languages" class="form-label">Idiomas</label>
                    <input type="text" class="form-control" id="languages" name="languages" />
                </div>
                <div class="mb-3">
                    <label for="approach" class="form-label">Enfoque</label>
                    <input type="text" class="form-control" id="approach" name="approach" />
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="age" name="age" min="0" />
                </div>
                <div class="mb-3">
                    <label for="studies" class="form-label">Estudios</label>
                    <input type="text" class="form-control" id="studies" name="studies" />
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Biografía</label>
                    <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Añadir Psicólogo</button>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach($psychologists as $psychologist)
        <div class="col-md-4">
            <div class="card psychologist-card">
                <img src="{{ $psychologist->photo_url }}" class="card-img-top psychologist-img" alt="{{ $psychologist->name }}" />
                <div class="card-body">
                    <h5 class="card-title">{{ $psychologist->name }}</h5>
                    <p class="text-primary">{{ $psychologist->specialty }}</p>
                    <p class="card-text">
                        <i class="fas fa-briefcase"></i> {{ $psychologist->experience }} años<br />
                        <i class="fas fa-language"></i> {{ $psychologist->languages }}
                    </p>
                    <a href="{{ url('/psychologists/'.$psychologist->id) }}" class="btn btn-primary">Ver perfil</a>
                    <a href="{{ route('psychologists.edit', $psychologist->id) }}" class="btn btn-secondary ms-2">Editar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Aquí puedes poner tus estilos personalizados */
    .psychologist-card {
        transition: all 0.3s ease;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .psychologist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    .psychologist-img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
</style>
@endsection
