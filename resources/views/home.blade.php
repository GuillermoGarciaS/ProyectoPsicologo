@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #fdf6ee;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .welcome-card, .guest-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 30px;
        margin-top: 40px;
        color: #333;
        text-align: center;
    }
    h1 {
        color: #002244;
        margin-bottom: 20px;
    }
    .btn-link {
        display: inline-block;
        background-color: #003366;
        color: white;
        padding: 12px 24px;
        border-radius: 6px;
        text-decoration: none;
        margin: 10px;
        transition: background-color 0.3s ease;
    }
    .btn-link:hover {
        background-color: #005599;
    }
</style>


<div class="container">
    @auth
        <div class="welcome-card">
            <h1>¡Bienvenido, {{ Auth::user()->name }}!</h1>
            <p>Tu correo electrónico: {{ Auth::user()->email }}</p>
        </div>
    @else
    <div class="guest-card">
    <h1>Bienvenido/a</h1>
    <p>Por favor, inicia sesión o regístrate para continuar.</p>
    <a href="{{ route('login') }}" class="btn-link">Iniciar sesión</a>
    <a href="{{ route('register') }}" class="btn-link">Registrarse</a>
</div>

    @endauth
</div>
@endsection
