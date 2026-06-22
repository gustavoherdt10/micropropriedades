@extends('layouts.app')

@section('title', $propriedade->nome)

@section('content')
@php
    $numeroWhatsapp = null;

    if ($propriedade->whatsapp) {
        $numeroWhatsapp = preg_replace('/\D/', '', $propriedade->whatsapp);

        if (!str_starts_with($numeroWhatsapp, '55')) {
            $numeroWhatsapp = '55' . $numeroWhatsapp;
        }
    }
@endphp

<div class="mb-4">
    <a href="{{ route('public.propriedades') }}" class="btn btn-outline-secondary btn-sm">
        Voltar para propriedades
    </a>
</div>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
            @if($propriedade->imagem)
                <img 
                    src="{{ asset('storage/' . $propriedade->imagem) }}" 
                    class="card-img-top"
                    style="height: 340px; object-fit: cover;"
                    alt="{{ $propriedade->nome }}"
                >
            @else
                <div 
                    class="bg-secondary-subtle d-flex align-items-center justify-content-center text-muted"
                    style="height: 340px;"
                >
                    Sem imagem
                </div>
            @endif

            <div class="card-body">
                <h1 class="h3">{{ $propriedade->nome }}</h1>

                <p class="text-muted mb-1">
                    {{ $propriedade->cidade }}
                    @if($propriedade->bairro)
                        - {{ $propriedade->bairro }}
                    @endif
                </p>

                @if($propriedade->endereco)
                    <p class="mb-1">
                        <strong>Endereço:</strong> {{ $propriedade->endereco }}
                    </p>
                @endif

                <p class="mb-1">
                    <strong>Responsável:</strong> {{ $propriedade->responsavel }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-7 mb-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                Sobre a propriedade
            </div>

            <div class="card-body">
                <p class="mb-0">
                    {{ $propriedade->descricao ?? 'Nenhuma descrição cadastrada.' }}
                </p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Contato
            </div>

            <div class="card-body">
                <p>
                    <strong>Telefone:</strong> {{ $propriedade->telefone ?? 'Não informado' }}
                </p>

                <p>
                    <strong>WhatsApp:</strong> {{ $propriedade->whatsapp ?? 'Não informado' }}
                </p>

                <p>
                    <strong>E-mail:</strong> {{ $propriedade->email ?? 'Não informado' }}
                </p>

                @if($numeroWhatsapp)
                    <a 
                        href="https://wa.me/{{ $numeroWhatsapp }}" 
                        target="_blank" 
                        class="btn btn-success"
                    >
                        Chamar no WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h2 class="mb-3">Produtos e serviços dessa propriedade</h2>

    <div class="row">
        @forelse($propriedade->produtosServicos->where('ativo', true) as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->imagem)
                        <img 
                            src="{{ asset('storage/' . $item->imagem) }}" 
                            class="card-img-top"
                            style="height: 200px; object-fit: cover;"
                            alt="{{ $item->nome }}"
                        >
                    @else
                        <div 
                            class="bg-secondary-subtle d-flex align-items-center justify-content-center text-muted"
                            style="height: 200px;"
                        >
                            Sem imagem
                        </div>
                    @endif

                    <div class="card-body">
                        @if($item->tipo === 'produto')
                            <span class="badge bg-success mb-2">Produto</span>
                        @else
                            <span class="badge bg-primary mb-2">Serviço</span>
                        @endif

                        <h5>{{ $item->nome }}</h5>

                        <p class="text-muted mb-1">
                            {{ $item->categoria->nome ?? 'Sem categoria' }}
                        </p>

                        <p>
                            {{ \Illuminate\Support\Str::limit($item->descricao, 100) }}
                        </p>

                        @if($item->preco_estimado)
                            <p class="fw-bold mb-1">
                                R$ {{ number_format($item->preco_estimado, 2, ',', '.') }}
                                @if($item->unidade)
                                    / {{ $item->unidade }}
                                @endif
                            </p>
                        @endif

                        @if($item->disponibilidade)
                            <p class="text-muted mb-0">
                                {{ $item->disponibilidade }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Esta propriedade ainda não possui produtos ou serviços cadastrados.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection