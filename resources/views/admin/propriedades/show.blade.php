@extends('layouts.app')

@section('title', 'Detalhes da Propriedade')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">{{ $propriedade->nome }}</h1>
        <p class="text-muted mb-0">Detalhes da propriedade cadastrada.</p>
    </div>

    <div>
        <a href="{{ route('admin.propriedades.edit', $propriedade) }}" class="btn btn-warning">
            Editar
        </a>

        <a href="{{ route('admin.propriedades.index') }}" class="btn btn-outline-secondary">
            Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
            @if($propriedade->imagem)
                <img 
                    src="{{ asset('storage/' . $propriedade->imagem) }}" 
                    alt="{{ $propriedade->nome }}"
                    class="card-img-top"
                    style="height: 300px; object-fit: cover;"
                >
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $propriedade->nome }}</h5>

                <p class="mb-1">
                    <strong>Responsável:</strong> {{ $propriedade->responsavel }}
                </p>

                <p class="mb-1">
                    <strong>Cidade:</strong> {{ $propriedade->cidade }}
                </p>

                <p class="mb-1">
                    <strong>Bairro/Localidade:</strong> {{ $propriedade->bairro ?? 'Não informado' }}
                </p>

                <p class="mb-1">
                    <strong>Endereço:</strong> {{ $propriedade->endereco ?? 'Não informado' }}
                </p>

                <p class="mb-1">
                    <strong>Status:</strong>
                    @if($propriedade->ativo)
                        <span class="badge bg-success">Ativa</span>
                    @else
                        <span class="badge bg-secondary">Inativa</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-7 mb-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                Informações de contato
            </div>

            <div class="card-body">
                <p><strong>Telefone:</strong> {{ $propriedade->telefone ?? 'Não informado' }}</p>
                <p><strong>WhatsApp:</strong> {{ $propriedade->whatsapp ?? 'Não informado' }}</p>
                <p><strong>E-mail:</strong> {{ $propriedade->email ?? 'Não informado' }}</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Descrição
            </div>

            <div class="card-body">
                <p class="mb-0">
                    {{ $propriedade->descricao ?? 'Nenhuma descrição cadastrada.' }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header bg-dark text-white">
        Produtos e serviços vinculados
    </div>

    <div class="card-body">
        @if($propriedade->produtosServicos->count() > 0)
            <div class="row">
                @foreach($propriedade->produtosServicos as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            @if($item->imagem)
                                <img 
                                    src="{{ asset('storage/' . $item->imagem) }}" 
                                    class="card-img-top"
                                    style="height: 160px; object-fit: cover;"
                                    alt="{{ $item->nome }}"
                                >
                            @endif

                            <div class="card-body">
                                <span class="badge bg-success mb-2">
                                    {{ ucfirst($item->tipo) }}
                                </span>

                                <h5>{{ $item->nome }}</h5>

                                <p class="text-muted mb-1">
                                    {{ $item->categoria->nome ?? 'Sem categoria' }}
                                </p>

                                <p>
                                    {{ \Illuminate\Support\Str::limit($item->descricao, 80) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0">
                Nenhum produto ou serviço vinculado a esta propriedade.
            </p>
        @endif
    </div>
</div>
@endsection