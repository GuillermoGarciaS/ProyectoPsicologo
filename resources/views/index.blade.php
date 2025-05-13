<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio de Psicólogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .psychologist-card {
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        .psychologist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .psychologist-img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="text-center mb-4">Directorio de Psicólogos</h1>
        
        <div class="row">
            @foreach($psychologists as $psychologist)
            <div class="col-md-4">
                <div class="card psychologist-card">
                    <img src="{{ $psychologist->photo_url }}" 
                         class="card-img-top psychologist-img" 
                         alt="{{ $psychologist->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $psychologist->name }}</h5>
                        <p class="text-primary">{{ $psychologist->specialty }}</p>
                        <p class="card-text">
                            <i class="fas fa-briefcase"></i> {{ $psychologist->experience }} años<br>
                            <i class="fas fa-language"></i> {{ $psychologist->languages }}
                        </p>
                        <a href="{{ url('/psychologists/'.$psychologist->id) }}" class="btn btn-primary">
                            Ver perfil
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>