@extends('layouts.app')

@section('title', 'Minhas Propriedades')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Minhas Propriedades</h1>
        <p class="text-muted mb-0">Gerencie as propriedades rurais e artesanais cadastradas.</p>
    </div>

    <a href="{{ route('admin.propriedades.create') }}" class="btn btn-success">
        Nova propriedade
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if($propriedades->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Responsável</th>
                            <th>Cidade</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($propriedades as $propriedade)
                            <tr>
                                <td style="width: 90px;">
                                    @if($propriedade->imagem)
                                        <img 
                                            src="{{ asset('storage/' . $propriedade->imagem) }}" 
                                            alt="{{ $propriedade->nome }}"
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
                                    <strong>{{ $propriedade->nome }}</strong>
                                </td>

                                <td>{{ $propriedade->responsavel }}</td>

                                <td>{{ $propriedade->cidade }}</td>

                                <td>
                                    @if($propriedade->ativo)
                                        <span class="badge bg-success">Ativa</span>
                                    @else
                                        <span class="badge bg-secondary">Inativa</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a 
                                        href="{{ route('admin.propriedades.show', $propriedade) }}" 
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Ver
                                    </a>

                                    <a 
                                        href="{{ route('admin.propriedades.edit', $propriedade) }}" 
                                        class="btn btn-sm btn-outline-warning"
                                    >
                                        Editar
                                    </a>

                                    <form 
                                        action="{{ route('admin.propriedades.destroy', $propriedade) }}" 
                                        method="POST" 
                                        class="d-inline"
                                        onsubmit="return confirm('Deseja realmente excluir esta propriedade?')"
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
                {{ $propriedades->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <h4>Nenhuma propriedade cadastrada</h4>
                <p class="text-muted">Cadastre sua primeira propriedade para começar a divulgar produtos e serviços.</p>

                <a href="{{ route('admin.propriedades.create') }}" class="btn btn-success">
                    Cadastrar propriedade
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 