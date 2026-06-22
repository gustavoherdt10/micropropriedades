@extends('layouts.app')

@section('title', 'Produtos e Serviços')

@section('content')
<div class="mb-4">
    <h1>Produtos e Serviços</h1>
    <p class="text-muted">
        Veja produtos coloniais, artesanais, alimentos, bebidas, flores, mudas e serviços turísticos da região.
    </p>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('public.produtos') }}" method="GET">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Buscar</label>
                    <input 
                        type="text" 
                        name="busca" 
                        class="form-control" 
                        value="{{ $busca ?? '' }}"
                        placeholder="Nome ou descrição"
                    >
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Tipo</label>
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

                <div class="col-md-3 mb-3">
                    <label class="form-label">Categoria</label>
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

                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        Filtrar
                    </button>
                </div>
            </div>

            @if(($busca ?? null) || ($tipo ?? null) || ($categoriaId ?? null))
                <a href="{{ route('public.produtos') }}" class="btn btn-outline-secondary btn-sm">
                    Limpar filtros
                </a>
            @endif
        </form>
    </div>
</div>

<div class="row">
    @forelse($produtos as $produto)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                @if($produto->imagem)
                    <img 
                        src="{{ asset('storage/' . $produto->imagem) }}" 
                        class="card-img-top"
                        style="height: 190px; object-fit: cover;"
                        alt="{{ $produto->nome }}"
                    >
                @else
                    <div 
                        class="bg-secondary-subtle d-flex align-items-center justify-content-center text-muted"
                        style="height: 190px;"
                    >
                        Sem imagem
                    </div>
                @endif

                <div class="card-body">
                    @if($produto->tipo === 'produto')
                        <span class="badge bg-success mb-2">Produto</span>
                    @else
                        <span class="badge bg-primary mb-2">Serviço</span>
                    @endif

                    <h5 class="card-title">{{ $produto->nome }}</h5>

                    <p class="text-muted mb-1">
                        {{ $produto->categoria->nome ?? 'Sem categoria' }}
                    </p>

                    <p class="small mb-2">
                        <strong>Propriedade:</strong>
                        @if($produto->propriedade)
                            <a 
                                href="{{ route('public.propriedades.show', $produto->propriedade) }}"
                                class="text-decoration-none"
                            >
                                {{ $produto->propriedade->nome }}
                            </a>
                        @else
                            Não informada
                        @endif
                    </p>

                    <p class="card-text">
                        {{ \Illuminate\Support\Str::limit($produto->descricao, 90) }}
                    </p>
                </div>

                <div class="card-footer bg-white">
                    @if($produto->preco_estimado)
                        <p class="fw-bold mb-1">
                            R$ {{ number_format($produto->preco_estimado, 2, ',', '.') }}

                            @if($produto->unidade)
                                / {{ $produto->unidade }}
                            @endif
                        </p>
                    @else
                        <p class="text-muted mb-1">Preço não informado</p>
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
            <div class="alert alert-warning">
                Nenhum produto ou serviço encontrado com os filtros informados.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $produtos->withQueryString()->links() }}
</div>
@endsection