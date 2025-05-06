<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Psicólogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">Editar Psicólogo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('psychologists.update', $psychologist->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $psychologist->name) }}" required />
            </div>

            <div class="mb-3">
                <label for="photo_url" class="form-label">URL de Foto</label>
                <input type="url" class="form-control" id="photo_url" name="photo_url" value="{{ old('photo_url', $psychologist->photo_url) }}" />
            </div>

            <div class="mb-3">
                <label for="specialty" class="form-label">Especialidad</label>
                <input type="text" class="form-control" id="specialty" name="specialty" value="{{ old('specialty', $psychologist->specialty) }}" />
            </div>

            <div class="mb-3">
                <label for="approach" class="form-label">Enfoque</label>
                <input type="text" class="form-control" id="approach" name="approach" value="{{ old('approach', $psychologist->approach) }}" />
            </div>

            <div class="mb-3">
                <label for="experience" class="form-label">Años de Experiencia</label>
                <input type="number" class="form-control" id="experience" name="experience" min="0" value="{{ old('experience', $psychologist->experience) }}" />
            </div>

            <div class="mb-3">
                <label for="languages" class="form-label">Idiomas</label>
                <input type="text" class="form-control" id="languages" name="languages" value="{{ old('languages', $psychologist->languages) }}" />
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Edad</label>
                <input type="number" class="form-control" id="age" name="age" min="0" value="{{ old('age', $psychologist->age) }}" />
            </div>

            <div class="mb-3">
                <label for="studies" class="form-label">Estudios</label>
                <input type="text" class="form-control" id="studies" name="studies" value="{{ old('studies', $psychologist->studies) }}" />
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biografía</label>
                <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $psychologist->bio) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Psicólogo</button>
            <a href="{{ route('psychologists.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>
</body>
</html>
