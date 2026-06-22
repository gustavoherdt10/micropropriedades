@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Criar conta</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ old('name') }}" 
                            required
                        >
                    </div>

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

                    <div class="mb-3">
                        <label class="form-label">Confirmar senha</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <button class="btn btn-success w-100">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection