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
    <a href="{{ route('public.propriedades') }}" class="btn btn-outline-secondary rounded-pill btn-sm">
        Voltar para propriedades
    </a>
</div>

<div class="row align-items-start">
    <div class="col-lg-5 mb-4">
        <div class="rural-card">
            @if($propriedade->imagem)
                <img 
                    src="{{ asset('storage/' . $propriedade->imagem) }}" 
                    class="w-100"
                    style="height: 390px; object-fit: cover;"
                    alt="{{ $propriedade->nome }}"
                >
            @else
                <div class="rural-card-placeholder" style="height: 390px;">
                    Sem imagem
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-7 mb-4">
        <span class="badge-rural mb-3 d-inline-block">
            {{ $propriedade->cidade }}
            @if($propriedade->bairro)
                - {{ $propriedade->bairro }}
            @endif
        </span>

        <h1 class="page-title mb-3">
            {{ $propriedade->nome }}
        </h1>

        <p class="page-subtitle mb-4">
            {{ $propriedade->descricao ?? 'Nenhuma descrição cadastrada.' }}
        </p>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    Informações da propriedade
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Responsável</small>
                        <strong>{{ $propriedade->responsavel }}</strong>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Endereço</small>
                        <strong>{{ $propriedade->endereco ?? 'Não informado' }}</strong>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">Telefone</small>
                        <strong>{{ $propriedade->telefone ?? 'Não informado' }}</strong>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block">WhatsApp</small>
                        <strong>{{ $propriedade->whatsapp ?? 'Não informado' }}</strong>
                    </div>

                    <div class="col-md-12">
                        <small class="text-muted d-block">E-mail</small>
                        <strong>{{ $propriedade->email ?? 'Não informado' }}</strong>
                    </div>
                </div>

                @if($numeroWhatsapp)
                    <a 
                        href="https://wa.me/{{ $numeroWhatsapp }}" 
                        target="_blank" 
                        class="btn btn-rural mt-4"
                    >
                        Chamar no WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<section class="section-block pt-3">
    <div class="section-heading">
        <span class="eyebrow">Catálogo da propriedade</span>
        <h2>Produtos e serviços disponíveis</h2>
        <p>
            Confira os itens cadastrados por esta propriedade.
        </p>
    </div>

    <div class="row">
        @forelse($propriedade->produtosServicos->where('ativo', true) as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="rural-card h-100">
                    @if($item->imagem)
                        <img 
                            src="{{ asset('storage/' . $item->imagem) }}" 
                            class="rural-card-img"
                            alt="{{ $item->nome }}"
                        >
                    @else
                        <div class="rural-card-placeholder">
                            Sem imagem
                        </div>
                    @endif

                    <div class="card-body p-4">
                        @if($item->tipo === 'produto')
                            <span class="badge-rural mb-3 d-inline-block">
                                Produto
                            </span>
                        @else
                            <span class="badge-service mb-3 d-inline-block">
                                Serviço
                            </span>
                        @endif

                        <h5 class="fw-bold">
                            {{ $item->nome }}
                        </h5>

                        <p class="text-muted small">
                            {{ $item->categoria->nome ?? 'Sem categoria' }}
                        </p>

                        <p class="text-muted">
                            {{ \Illuminate\Support\Str::limit($item->descricao, 110) }}
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
                            <small class="text-muted">
                                {{ $item->disponibilidade }}
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning rounded-4">
                    Esta propriedade ainda não possui produtos ou serviços cadastrados.
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection