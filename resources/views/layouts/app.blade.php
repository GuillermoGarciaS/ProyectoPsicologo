<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Psicólogos Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #E74C3C;
            --accent-color: #3498DB;
            --light-gray: #F5F5F5;
            --dark-gray: #333;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
            color: var(--dark-gray);
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        h1, h2, h3 {
            color: var(--primary-color);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2rem;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--accent-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #2980B9;
        }

        .btn-primary {
            background: var(--primary-color);
        }

        .btn-primary:hover {
            background: #1A252F;
        }

        .match-percentage {
            color: var(--secondary-color);
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Psicólogos Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/user') }}">Dashboard Usuario</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/psychologists') }}">Psicólogos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/questions') }}">Test</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        @yield('content')
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        &copy; {{ date('Y') }} Psicólogos Online. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
