@extends('layouts.app')

@section('title', 'Editar Propriedade')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Editar Propriedade</h1>
        <p class="text-muted mb-0">Atualize os dados da propriedade cadastrada.</p>
    </div>

    <a href="{{ route('admin.propriedades.index') }}" class="btn btn-outline-secondary">
        Voltar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form 
            action="{{ route('admin.propriedades.update', $propriedade) }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Nome da propriedade</label>
                    <input 
                        type="text" 
                        name="nome" 
                        class="form-control" 
                        value="{{ old('nome', $propriedade->nome) }}" 
                        required
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Responsável</label>
                    <input 
                        type="text" 
                        name="responsavel" 
                        class="form-control" 
                        value="{{ old('responsavel', $propriedade->responsavel) }}" 
                        required
                    >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Telefone</label>
                    <input 
                        type="text" 
                        name="telefone" 
                        class="form-control" 
                        value="{{ old('telefone', $propriedade->telefone) }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">WhatsApp</label>
                    <input 
                        type="text" 
                        name="whatsapp" 
                        class="form-control" 
                        value="{{ old('whatsapp', $propriedade->whatsapp) }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">E-mail</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        value="{{ old('email', $propriedade->email) }}"
                    >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Cidade</label>
                    <input 
                        type="text" 
                        name="cidade" 
                        class="form-control" 
                        value="{{ old('cidade', $propriedade->cidade) }}" 
                        required
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Bairro / Localidade</label>
                    <input 
                        type="text" 
                        name="bairro" 
                        class="form-control" 
                        value="{{ old('bairro', $propriedade->bairro) }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Endereço</label>
                    <input 
                        type="text" 
                        name="endereco" 
                        class="form-control" 
                        value="{{ old('endereco', $propriedade->endereco) }}"
                    >
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição da propriedade</label>
                <textarea 
                    name="descricao" 
                    class="form-control" 
                    rows="5"
                >{{ old('descricao', $propriedade->descricao) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagem atual</label>

                <div>
                    @if($propriedade->imagem)
                        <img 
                            src="{{ asset('storage/' . $propriedade->imagem) }}" 
                            alt="{{ $propriedade->nome }}"
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
                    {{ old('ativo', $propriedade->ativo) ? 'checked' : '' }}
                >
                <label for="ativo" class="form-check-label">
                    Propriedade ativa no site
                </label>
            </div>

            <button type="submit" class="btn btn-success">
                Atualizar propriedade
            </button>

            <a href="{{ route('admin.propriedades.index') }}" class="btn btn-outline-secondary">
                Cancelar
            </a>
        </form>
    </div>
</div>
@endsection