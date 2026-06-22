@extends('layouts.app')

@section('title', 'Início - Ruraliza Ituporanga')

@section('content')
<section class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold text-success">
            Produtos rurais e artesanais da nossa região
        </h1>

        <p class="col-md-8 fs-5">
            Uma vitrine digital para divulgar micropropriedades rurais,
            produtores artesanais, produtos coloniais, serviços turísticos
            e negócios locais de Ituporanga e municípios próximos.
        </p>

        <a href="{{ route('public.propriedades') }}" class="btn btn-success btn-lg">
            Ver propriedades
        </a>

        <a href="{{ route('public.produtos') }}" class="btn btn-outline-success btn-lg">
            Ver produtos e serviços
        </a>
    </div>
</section>

<section class="mb-5">
    <h2 class="mb-3">Propriedades em destaque</h2>

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
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $propriedade->nome }}</h5>
                        <p class="card-text text-muted">
                            {{ $propriedade->cidade }}
                        </p>
                        <p class="card-text">
                            {{ Str::limit($propriedade->descricao, 100) }}
                        </p>
                    </div>

                    <div class="card-footer bg-white">
                        <a 
                            href="{{ route('public.propriedades.show', $propriedade) }}" 
                            class="btn btn-sm btn-success"
                        >
                            Ver detalhes
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>Nenhuma propriedade cadastrada até o momento.</p>
        @endforelse
    </div>
</section>
@endsection