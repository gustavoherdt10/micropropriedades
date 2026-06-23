@extends('layouts.app')

@section('title', 'Início - Ruraliza Alto Vale')

@section('content')
<section 
    class="hero-rural" 
    style="--hero-bg: url('{{ asset('img/hero-rural.jpg') }}');"
>
    <div class="container hero-rural-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-kicker">
                    Ituporanga e região
                </div>

                <h1 class="hero-title">
                    Produtos <span>rurais</span> e artesanais perto de você
                </h1>

                <p class="hero-subtitle">
                    Uma vitrine digital para divulgar pequenas propriedades, produtores locais,
                    alimentos coloniais, artesanatos, flores, mudas e serviços de turismo rural.
                </p>

                <div class="hero-highlight">
                    + <span>visibilidade</span> para quem produz no campo
                </div>
            </div>

            <div class="col-lg-5">
                <div class="search-panel">
                    <form action="{{ route('public.produtos') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label fw-bold">O que você procura?</label>
                            <input 
                                type="text" 
                                name="busca" 
                                class="form-control" 
                                placeholder="Ex: mel, queijo, artesanato, turismo..."
                            >
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tipo</label>
                                <select name="tipo" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="produto">Produtos</option>
                                    <option value="servico">Serviços</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Categoria</label>
                                <select name="categoria_id" class="form-select">
                                    <option value="">Todas</option>

                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-rural w-100">
                            Buscar produtos e serviços
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Vitrine regional</span>
        <h2>Conheça as propriedades cadastradas</h2>
        <p>
            Pequenos produtores, negócios artesanais e propriedades rurais ganham espaço para apresentar sua história,
            seus produtos e seus canais de contato.
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

                        <h5 class="fw-bold mb-2">
                            {{ $propriedade->nome }}
                        </h5>

                        <p class="text-muted mb-3">
                            {{ \Illuminate\Support\Str::limit($propriedade->descricao, 110) }}
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
                    Nenhuma propriedade cadastrada até o momento.
                </div>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('public.propriedades') }}" class="btn btn-outline-success rounded-pill px-4">
            Ver todas as propriedades
        </a>
    </div>
</section>

<section class="section-block pt-0">
    <div class="section-heading">
        <span class="eyebrow">Produtos e serviços</span>
        <h2>Itens divulgados na plataforma</h2>
        <p>
            Produtos coloniais, alimentos artesanais, bebidas, flores, mudas, experiências rurais
            e outros serviços oferecidos por produtores da região.
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
                            <span class="badge-rural mb-3 d-inline-block">Produto</span>
                        @else
                            <span class="badge-service mb-3 d-inline-block">Serviço</span>
                        @endif

                        <h5 class="fw-bold mb-2">
                            {{ $produto->nome }}
                        </h5>

                        <p class="text-muted small mb-2">
                            {{ $produto->categoria->nome ?? 'Sem categoria' }}
                        </p>

                        <p class="text-muted">
                            {{ \Illuminate\Support\Str::limit($produto->descricao, 80) }}
                        </p>

                        @if($produto->propriedade)
                            <a 
                                href="{{ route('public.propriedades.show', $produto->propriedade) }}" 
                                class="fw-bold text-success"
                            >
                                {{ $produto->propriedade->nome }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning rounded-4">
                    Nenhum produto ou serviço cadastrado até o momento.
                </div>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('public.produtos') }}" class="btn btn-rural-yellow">
            Ver produtos e serviços
        </a>
    </div>
</section>

<section class="mb-5">
    <div class="info-strip">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-2">
                    Quer divulgar uma propriedade, produto ou serviço?
                </h3>

                <p class="mb-lg-0">
                    Cadastre-se na plataforma e anuncie produtos coloniais, artesanatos, alimentos,
                    bebidas e experiências rurais. Simples, direto e com a cara da nossa região.
                </p>
            </div>

            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('register') }}" class="btn btn-rural-yellow">
                    Anunciar agora
                </a>
            </div>
        </div>
    </div>
</section>
@endsection