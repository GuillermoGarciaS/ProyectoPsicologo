@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvendio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        {{ __('Has Iniciado Sesion') }}<br>
                        <strong>{{ $user->name }}</strong>
                        <div class="mt-3">
                            <a href="{{ route('User.Dashboard') }}" class="btn btn-primary">
                                Go to Dashboard
                            </a>
                        </div>
                    @else
                        <p>Bienvenido por favor inicia sesion o registrate.</p>
                        <div class="mt-3">
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection