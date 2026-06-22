@extends('layouts.app')

@section('title', 'Produtos e Serviços')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Produtos e Serviços</h1>
        <p class="text-muted mb-0">Gerencie os produtos e serviços divulgados no site.</p>
    </div>

    <a href="{{ route('admin.produtos.create') }}" class="btn btn-success">
        Novo cadastro
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if($produtos->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Propriedade</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td style="width: 90px;">
                                    @if($produto->imagem)
                                        <img 
                                            src="{{ asset('storage/' . $produto->imagem) }}" 
                                            alt="{{ $produto->nome }}"
                                            class="rounded"
                                            style="width: 70px; height: 55px; object-fit: cover;"
                                        >
                                    @else
                                        <div 
                                            class="bg-secondary-subtle rounded d-flex align-items-center justify-content-center text-muted"
                                            style="width: 70px; height: 55px;"
                                        >
                                            Sem foto
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $produto->nome }}</strong>
                                </td>

                                <td>
                                    @if($produto->tipo === 'produto')
                                        <span class="badge bg-success">Produto</span>
                                    @else
                                        <span class="badge bg-primary">Serviço</span>
                                    @endif
                                </td>

                                <td>{{ $produto->categoria->nome ?? 'Sem categoria' }}</td>

                                <td>{{ $produto->propriedade->nome ?? 'Não informado' }}</td>

                                <td>
                                    @if($produto->preco_estimado)
                                        R$ {{ number_format($produto->preco_estimado, 2, ',', '.') }}
                                    @else
                                        Não informado
                                    @endif
                                </td>

                                <td>
                                    @if($produto->ativo)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-secondary">Inativo</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a 
                                        href="{{ route('admin.produtos.show', $produto) }}" 
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Ver
                                    </a>

                                    <a 
                                        href="{{ route('admin.produtos.edit', $produto) }}" 
                                        class="btn btn-sm btn-outline-warning"
                                    >
                                        Editar
                                    </a>

                                    <form 
                                        action="{{ route('admin.produtos.destroy', $produto) }}" 
                                        method="POST" 
                                        class="d-inline"
                                        onsubmit="return confirm('Deseja realmente excluir este cadastro?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $produtos->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <h4>Nenhum produto ou serviço cadastrado</h4>
                <p class="text-muted">Cadastre produtos, alimentos, artesanatos, bebidas ou serviços turísticos.</p>

                <a href="{{ route('admin.produtos.create') }}" class="btn btn-success">
                    Cadastrar produto ou serviço
                </a>
            </div>
        @endif
    </div>
</div>
@endsection