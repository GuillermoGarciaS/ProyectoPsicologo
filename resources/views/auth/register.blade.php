@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0">Crear Cuenta</h3>
                </div>

                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label text-muted">Nombre</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       style="border-radius: 0.5rem; padding: 12px; border: 1px solid #e0e0e0;">
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="lastname" class="form-label text-muted">Apellido</label>
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" 
                                       name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                       style="border-radius: 0.5rem; padding: 12px; border: 1px solid #e0e0e0;">
                                
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-muted">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   style="border-radius: 0.5rem; padding: 12px; border: 1px solid #e0e0e0;">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="password" class="form-label text-muted">Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password"
                                       style="border-radius: 0.5rem; padding: 12px; border: 1px solid #e0e0e0;">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label text-muted">Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" 
                                       name="password_confirmation" required autocomplete="new-password"
                                       style="border-radius: 0.5rem; padding: 12px; border: 1px solid #e0e0e0;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label text-muted" for="terms">
                                    Acepto los <a href="#" class="text-primary">Términos y Condiciones</a> y la <a href="#" class="text-primary">Política de Privacidad</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-3" style="border-radius: 0.5rem; font-weight: 600;">
                                REGISTRARME
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary">Inicia sesión aquí</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection