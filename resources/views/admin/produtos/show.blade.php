@extends('layouts.app')

@section('title', 'Detalhes do Produto ou Serviço')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">{{ $produto->nome }}</h1>
        <p class="text-muted mb-0">Detalhes do produto ou serviço cadastrado.</p>
    </div>

    <div>
        <a href="{{ route('admin.produtos.edit', $produto) }}" class="btn btn-warning">
            Editar
        </a>

        <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary">
            Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
            @if($produto->imagem)
                <img 
                    src="{{ asset('storage/' . $produto->imagem) }}" 
                    alt="{{ $produto->nome }}"
                    class="card-img-top"
                    style="height: 300px; object-fit: cover;"
                >
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $produto->nome }}</h5>

                <p class="mb-1">
                    <strong>Tipo:</strong>
                    @if($produto->tipo === 'produto')
                        <span class="badge bg-success">Produto</span>
                    @else
                        <span class="badge bg-primary">Serviço</span>
                    @endif
                </p>

                <p class="mb-1">
                    <strong>Categoria:</strong> {{ $produto->categoria->nome ?? 'Sem categoria' }}
                </p>

                <p class="mb-1">
                    <strong>Propriedade:</strong> {{ $produto->propriedade->nome ?? 'Não informado' }}
                </p>

                <p class="mb-1">
                    <strong>Status:</strong>
                    @if($produto->ativo)
                        <span class="badge bg-success">Ativo</span>
                    @else
                        <span class="badge bg-secondary">Inativo</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-7 mb-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                Informações comerciais
            </div>

            <div class="card-body">
                <p>
                    <strong>Preço estimado:</strong>
                    @if($produto->preco_estimado)
                        R$ {{ number_format($produto->preco_estimado, 2, ',', '.') }}
                    @else
                        Não informado
                    @endif
                </p>

                <p>
                    <strong>Unidade:</strong> {{ $produto->unidade ?? 'Não informado' }}
                </p>

                <p>
                    <strong>Disponibilidade:</strong> {{ $produto->disponibilidade ?? 'Não informado' }}
                </p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Descrição
            </div>

            <div class="card-body">
                <p class="mb-0">
                    {{ $produto->descricao ?? 'Nenhuma descrição cadastrada.' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection