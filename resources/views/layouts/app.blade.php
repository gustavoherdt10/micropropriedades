<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <title>@yield('title', 'Ruraliza Ituporanga')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/ruraliza.css') }}">
</head>

<body>

<div class="rural-topbar">
    <div class="rural-topbar-track">
        <span>Produtos coloniais direto do produtor</span>
        <span>Artesanato rural e regional</span>
        <span>Turismo rural em Ituporanga e região</span>
        <span>Flores, mudas, alimentos e serviços locais</span>
        <span>Valorizando quem produz no campo</span>

        <span>Produtos coloniais direto do produtor</span>
        <span>Artesanato rural e regional</span>
        <span>Turismo rural em Ituporanga e região</span>
        <span>Flores, mudas, alimentos e serviços locais</span>
        <span>Valorizando quem produz no campo</span>
    </div>
</div>

<nav class="navbar navbar-expand-lg site-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand fw-black fs-3" href="{{ route('home') }}">
            Ruraliza<span>.</span>
        </a>

        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#menuPrincipal"
            aria-controls="menuPrincipal"
            aria-expanded="false"
            aria-label="Alternar navegação"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a 
                        href="{{ route('home') }}" 
                        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                    >
                        Início
                    </a>
                </li>

                <li class="nav-item">
                    <a 
                        href="{{ route('public.propriedades') }}" 
                        class="nav-link {{ request()->routeIs('public.propriedades*') ? 'active' : '' }}"
                    >
                        Propriedades
                    </a>
                </li>

                <li class="nav-item">
                    <a 
                        href="{{ route('public.produtos') }}" 
                        class="nav-link {{ request()->routeIs('public.produtos') ? 'active' : '' }}"
                    >
                        Produtos e Serviços
                    </a>
                </li>

                @auth
                    <li class="nav-item">
                        <a 
                            href="{{ route('admin.dashboard') }}" 
                            class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                        >
                            Painel
                        </a>
                    </li>

                    <li class="nav-item mt-2 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button class="btn btn-outline-success rounded-pill px-3" type="submit">
                                Sair
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            Entrar
                        </a>
                    </li>

                    <li class="nav-item mt-2 mt-lg-0">
                        <a href="{{ route('register') }}" class="btn btn-rural-yellow">
                            Cadastrar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success rounded-4 shadow-sm border-0">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger rounded-4 shadow-sm border-0">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger rounded-4 shadow-sm border-0">
                <strong>Verifique os campos abaixo:</strong>

                <ul class="mb-0">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<footer class="footer-rural text-center py-4">
    <div class="container">
        <strong>Ruraliza Ituporanga</strong>

        <br>

        <small>
            Projeto de Extensão - Programação Web 2 | Divulgação de produtos e serviços rurais e artesanais
        </small>
    </div>
</footer>

<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>