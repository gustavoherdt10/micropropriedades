@extends('layouts.app')

@section('title', 'Produtos e Serviços')

@section('content')
<section 
    class="page-hero" 
    style="--page-bg: url('{{ asset('img/hero-rural.jpg') }}');"
>
    <div class="container">
        <h1>Produtos e serviços</h1>

        <p>
            Veja produtos coloniais, artesanais, alimentos, bebidas, flores, mudas
            e serviços turísticos oferecidos por produtores da região.
        </p>
    </div>
</section>

<div class="filter-card card shadow-sm mb-5">
    <div class="card-body p-4">
        <form action="{{ route('public.produtos') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Buscar</label>
                    <input 
                        type="text" 
                        name="busca" 
                        class="form-control" 
                        value="{{ $busca ?? '' }}"
                        placeholder="Nome ou descrição"
                    >
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="">Todos</option>
                        <option value="produto" {{ ($tipo ?? '') === 'produto' ? 'selected' : '' }}>
                            Produtos
                        </option>
                        <option value="servico" {{ ($tipo ?? '') === 'servico' ? 'selected' : '' }}>
                            Serviços
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Categoria</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Todas</option>

                        @foreach($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}"
                                {{ ($categoriaId ?? '') == $categoria->id ? 'selected' : '' }}
                            >
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-rural w-100">
                        Buscar
                    </button>
                </div>
            </div>

            @if(($busca ?? null) || ($tipo ?? null) || ($categoriaId ?? null))
                <div class="mt-3">
                    <a href="{{ route('public.produtos') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Limpar filtros
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="section-heading">
    <span class="eyebrow">Catálogo regional</span>
    <h2>Itens disponíveis</h2>
    <p>
        Explore os produtos e serviços cadastrados pelos produtores e propriedades participantes.
    </p>
</div>

<div class="row">
    @forelse($produtos as $produto)
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="rural-card h-100">
                @if($produto->imagem)
                    <img 
                        src="{{ asset('storage/' . $produto->imagem) }}" 
                        class="rural-card-img"
                        alt="{{ $produto->nome }}"
                    >
                @else
                    <div class="rural-card-placeholder">
                        Sem imagem
                    </div>
                @endif

                <div class="card-body p-4">
                    @if($produto->tipo === 'produto')
                        <span class="badge-rural mb-3 d-inline-block">
                            Produto
                        </span>
                    @else
                        <span class="badge-service mb-3 d-inline-block">
                            Serviço
                        </span>
                    @endif

                    <h5 class="fw-bold">
                        {{ $produto->nome }}
                    </h5>

                    <p class="text-muted small mb-2">
                        {{ $produto->categoria->nome ?? 'Sem categoria' }}
                    </p>

                    <p class="text-muted">
                        {{ \Illuminate\Support\Str::limit($produto->descricao, 90) }}
                    </p>

                    @if($produto->propriedade)
                        <p class="small mb-2">
                            <strong>Propriedade:</strong>

                            <a 
                                href="{{ route('public.propriedades.show', $produto->propriedade) }}"
                                class="text-success fw-bold"
                            >
                                {{ $produto->propriedade->nome }}
                            </a>
                        </p>
                    @endif
                </div>

                <div class="card-footer bg-white border-0 px-4 pb-4">
                    @if($produto->preco_estimado)
                        <p class="fw-bold mb-1">
                            R$ {{ number_format($produto->preco_estimado, 2, ',', '.') }}

                            @if($produto->unidade)
                                / {{ $produto->unidade }}
                            @endif
                        </p>
                    @else
                        <p class="text-muted mb-1">
                            Preço não informado
                        </p>
                    @endif

                    @if($produto->disponibilidade)
                        <small class="text-muted">
                            {{ $produto->disponibilidade }}
                        </small>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning rounded-4">
                Nenhum produto ou serviço encontrado com os filtros informados.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $produtos->withQueryString()->links() }}
</div>
@endsection