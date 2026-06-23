@extends('layouts.app')

@section('title', 'Propriedades Rurais e Artesanais')

@section('content')
<section 
    class="page-hero" 
    style="--page-bg: url('{{ asset('img/hero-rural.jpg') }}');"
>
    <div class="container">
        <h1>Propriedades rurais e artesanais</h1>

        <p>
            Conheça pequenas propriedades, produtores rurais e negócios artesanais de Ituporanga
            e municípios da região.
        </p>
    </div>
</section>

<div class="filter-card card shadow-sm mb-5">
    <div class="card-body p-4">
        <form action="{{ route('public.propriedades') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Buscar propriedade</label>
                    <input 
                        type="text" 
                        name="busca" 
                        class="form-control" 
                        value="{{ $busca ?? '' }}"
                        placeholder="Nome, responsável ou descrição"
                    >
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-bold">Cidade</label>
                    <input 
                        type="text" 
                        name="cidade" 
                        class="form-control" 
                        value="{{ $cidade ?? '' }}"
                        placeholder="Ex: Ituporanga, Aurora, Petrolândia"
                    >
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-rural w-100">
                        Buscar
                    </button>
                </div>
            </div>

            @if(($busca ?? null) || ($cidade ?? null))
                <div class="mt-3">
                    <a href="{{ route('public.propriedades') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Limpar filtros
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="section-heading">
    <span class="eyebrow">Resultados</span>
    <h2>Propriedades encontradas</h2>
    <p>
        Veja os cadastros disponíveis na plataforma e acesse os detalhes de cada propriedade.
    </p>
</div>

<div class="row">
    @forelse($propriedades as $propriedade)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="rural-card h-100">
                @if($propriedade->imagem)
                    <img 
                        src="{{ asset('storage/' . $propriedade->imagem) }}" 
                        class="rural-card-img"
                        alt="{{ $propriedade->nome }}"
                    >
                @else
                    <div class="rural-card-placeholder">
                        Sem imagem
                    </div>
                @endif

                <div class="card-body p-4">
                    <span class="badge-rural mb-3 d-inline-block">
                        {{ $propriedade->cidade }}
                    </span>

                    <h5 class="fw-bold">
                        {{ $propriedade->nome }}
                    </h5>

                    @if($propriedade->bairro)
                        <p class="text-muted mb-2">
                            {{ $propriedade->bairro }}
                        </p>
                    @endif

                    <p class="text-muted">
                        {{ \Illuminate\Support\Str::limit($propriedade->descricao, 120) }}
                    </p>

                    <a 
                        href="{{ route('public.propriedades.show', $propriedade) }}" 
                        class="btn btn-rural btn-sm"
                    >
                        Ver detalhes
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning rounded-4">
                Nenhuma propriedade encontrada com os filtros informados.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $propriedades->withQueryString()->links() }}
</div>
@endsection