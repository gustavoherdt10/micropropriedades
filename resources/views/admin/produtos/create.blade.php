@extends('layouts.app')

@section('title', 'Cadastrar Produto ou Serviço')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Cadastrar Produto ou Serviço</h1>
        <p class="text-muted mb-0">Informe os dados do item que será divulgado no site.</p>
    </div>

    <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary">
        Voltar
    </a>
</div>

@if($propriedades->count() === 0)
    <div class="alert alert-warning">
        Antes de cadastrar um produto ou serviço, é necessário cadastrar pelo menos uma propriedade.
        <a href="{{ route('admin.propriedades.create') }}" class="alert-link">Cadastrar propriedade</a>.
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form 
            action="{{ route('admin.produtos.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Propriedade</label>
                    <select name="propriedade_id" class="form-select" required>
                        <option value="">Selecione uma propriedade</option>

                        @foreach($propriedades as $propriedade)
                            <option 
                                value="{{ $propriedade->id }}"
                                {{ old('propriedade_id') == $propriedade->id ? 'selected' : '' }}
                            >
                                {{ $propriedade->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option value="produto" {{ old('tipo') === 'produto' ? 'selected' : '' }}>
                            Produto
                        </option>

                        <option value="servico" {{ old('tipo') === 'servico' ? 'selected' : '' }}>
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
                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}
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
                    value="{{ old('nome') }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea 
                    name="descricao" 
                    class="form-control" 
                    rows="5"
                    placeholder="Descreva o produto, serviço, forma de produção, diferenciais e informações importantes."
                >{{ old('descricao') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Preço estimado</label>
                    <input 
                        type="number" 
                        name="preco_estimado" 
                        class="form-control" 
                        value="{{ old('preco_estimado') }}"
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
                        value="{{ old('unidade') }}"
                        placeholder="Ex: kg, unidade, litro, visita"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Disponibilidade</label>
                    <input 
                        type="text" 
                        name="disponibilidade" 
                        class="form-control" 
                        value="{{ old('disponibilidade') }}"
                        placeholder="Ex: sob encomenda, semanal, safra"
                    >
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Imagem</label>
                <input 
                    type="file" 
                    name="imagem" 
                    class="form-control"
                    accept="image/*"
                >
                <small class="text-muted">Formatos aceitos: JPG, PNG, JPEG. Tamanho máximo: 2MB.</small>
            </div>

            <button 
                type="submit" 
                class="btn btn-success"
                {{ $propriedades->count() === 0 ? 'disabled' : '' }}
            >
                Salvar cadastro
            </button>

            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary">
                Cancelar
            </a>
        </form>
    </div>
</div>
@endsection