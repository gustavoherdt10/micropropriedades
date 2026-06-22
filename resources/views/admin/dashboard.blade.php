@extends('layouts.app')

@section('title', 'Painel Administrativo')

@section('content')
<h1 class="mb-4">Painel Administrativo</h1>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <h5 class="card-title">Minhas propriedades</h5>
                <p class="display-6 text-success">{{ $totalPropriedades }}</p>

                <a href="{{ route('admin.propriedades.index') }}" class="btn btn-success">
                    Gerenciar propriedades
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <h5 class="card-title">Produtos e serviços</h5>
                <p class="display-6 text-success">{{ $totalProdutos }}</p>

                <a href="{{ route('admin.produtos.index') }}" class="btn btn-success">
                    Gerenciar produtos e serviços
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm">
    <div class="card-body">
        <h5>Atalhos</h5>

        <a href="{{ route('admin.propriedades.create') }}" class="btn btn-outline-success">
            Cadastrar propriedade
        </a>

        <a href="{{ route('admin.produtos.create') }}" class="btn btn-outline-success">
            Cadastrar produto ou serviço
        </a>
    </div>
</div>
@endsection