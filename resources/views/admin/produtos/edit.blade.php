@extends('layouts.app')

@section('title', 'Editar Produto ou Serviço')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Editar Produto ou Serviço</h1>
        <p class="text-muted mb-0">Atualize as informações do cadastro.</p>
    </div>

    <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary">
        Voltar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form 
            action="{{ route('admin.produtos.update', $produto) }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Propriedade</label>
                    <select name="propriedade_id" class="form-select" required>
                        <option value="">Selecione uma propriedade</option>

                        @foreach($propriedades as $propriedade)
                            <option 
                                value="{{ $propriedade->id }}"
                                {{ old('propriedade_id', $produto->propriedade_id) == $propriedade->id ? 'selected' : '' }}
                            >
                                {{ $propriedade->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option 
                            value="produto" 
                            {{ old('tipo', $produto->tipo) === 'produto' ? 'selected' : '' }}
                        >
                            Produto
                        </option>

                        <option 
                            value="servico" 
                            {{ old('tipo', $produto->tipo) === 'servico' ? 'selected' : '' }}
                        >
                            Serviço
                        </option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Categoria</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Sem categoria</option>

                        @foreach($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}"
                                {{ old('categoria_id', $produto->categoria_id) == $categoria->id ? 'selected' : '' }}
                            >
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nome do produto ou serviço</label>
                <input 
                    type="text" 
                    name="nome" 
                    class="form-control" 
                    value="{{ old('nome', $produto->nome) }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea 
                    name="descricao" 
                    class="form-control" 
                    rows="5"
                >{{ old('descricao', $produto->descricao) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Preço estimado</label>
                    <input 
                        type="number" 
                        name="preco_estimado" 
                        class="form-control" 
                        value="{{ old('preco_estimado', $produto->preco_estimado) }}"
                        step="0.01"
                        min="0"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Unidade</label>
                    <input 
                        type="text" 
                        name="unidade" 
                        class="form-control" 
                        value="{{ old('unidade', $produto->unidade) }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Disponibilidade</label>
                    <input 
                        type="text" 
                        name="disponibilidade" 
                        class="form-control" 
                        value="{{ old('disponibilidade', $produto->disponibilidade) }}"
                    >
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagem atual</label>

                <div>
                    @if($produto->imagem)
                        <img 
                            src="{{ asset('storage/' . $produto->imagem) }}" 
                            alt="{{ $produto->nome }}"
                            class="rounded mb-2"
                            style="width: 180px; height: 120px; object-fit: cover;"
                        >
                    @else
                        <p class="text-muted">Nenhuma imagem cadastrada.</p>
                    @endif
                </div>

                <input 
                    type="file" 
                    name="imagem" 
                    class="form-control"
                    accept="image/*"
                >
                <small class="text-muted">Envie uma nova imagem apenas se desejar substituir a atual.</small>
            </div>

            <div class="form-check mb-4">
                <input 
                    type="checkbox" 
                    name="ativo" 
                    value="1" 
                    class="form-check-input" 
                    id="ativo"
                    {{ old('ativo', $produto->ativo) ? 'checked' : '' }}
                >
                <label for="ativo" class="form-check-label">
                    Produto ou serviço ativo no site
                </label>
            </div>

            <button type="submit" class="btn btn-success">
                Atualizar cadastro
            </button>

            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary">
                Cancelar
            </a>
        </form>
    </div>
</div>
@endsection