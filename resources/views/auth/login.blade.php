@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Entrar no sistema</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            value="{{ old('email') }}" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="form-check mb-3">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="form-check-input" 
                            id="remember"
                        >
                        <label for="remember" class="form-check-label">
                            Manter conectado
                        </label>
                    </div>

                    <button class="btn btn-success w-100">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection