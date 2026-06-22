@extends('layouts.app')

@section('title', 'Propriedades Rurais e Artesanais')

@section('content')
<div class="mb-4">
    <h1>Propriedades Rurais e Artesanais</h1>
    <p class="text-muted">
        Conheça pequenas propriedades, produtores rurais e negócios artesanais de Ituporanga e região.
    </p>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('public.propriedades') }}" method="GET">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label class="form-label">Buscar</label>
                    <input 
                        type="text" 
                        name="busca" 
                        class="form-control" 
                        value="{{ $busca ?? '' }}"
                        placeholder="Nome, responsável ou descrição"
                    >
                </div>

                <div class="col-md-5 mb-3">
                    <label class="form-label">Cidade</label>
                    <input 
                        type="text" 
                        name="cidade" 
                        class="form-control" 
                        value="{{ $cidade ?? '' }}"
                        placeholder="Ex: Ituporanga, Aurora, Petrolândia"
                    >
                </div>

                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        Filtrar
                    </button>
                </div>
            </div>

            @if(($busca ?? null) || ($cidade ?? null))
                <a href="{{ route('public.propriedades') }}" class="btn btn-outline-secondary btn-sm">
                    Limpar filtros
                </a>
            @endif
        </form>
    </div>
</div>

<div class="row">
    @forelse($propriedades as $propriedade)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($propriedade->imagem)
                    <img 
                        src="{{ asset('storage/' . $propriedade->imagem) }}" 
                        class="card-img-top"
                        style="height: 220px; object-fit: cover;"
                        alt="{{ $propriedade->nome }}"
                    >
                @else
                    <div 
                        class="bg-secondary-subtle d-flex align-items-center justify-content-center text-muted"
                        style="height: 220px;"
                    >
                        Sem imagem
                    </div>
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $propriedade->nome }}</h5>

                    <p class="text-muted mb-1">
                        {{ $propriedade->cidade }}
                        @if($propriedade->bairro)
                            - {{ $propriedade->bairro }}
                        @endif
                    </p>

                    <p class="card-text">
                        {{ \Illuminate\Support\Str::limit($propriedade->descricao, 120) }}
                    </p>
                </div>

                <div class="card-footer bg-white">
                    <a 
                        href="{{ route('public.propriedades.show', $propriedade) }}" 
                        class="btn btn-success btn-sm"
                    >
                        Ver detalhes
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning">
                Nenhuma propriedade encontrada com os filtros informados.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $propriedades->withQueryString()->links() }}
</div>
@endsection