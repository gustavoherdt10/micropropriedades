@extends('layouts.app')

@section('title', 'Cadastrar Propriedade')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Cadastrar Propriedade</h1>
        <p class="text-muted mb-0">Informe os dados da propriedade rural ou artesanal.</p>
    </div>

    <a href="{{ route('admin.propriedades.index') }}" class="btn btn-outline-secondary">
        Voltar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form 
            action="{{ route('admin.propriedades.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Nome da propriedade</label>
                    <input 
                        type="text" 
                        name="nome" 
                        class="form-control" 
                        value="{{ old('nome') }}" 
                        required
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Responsável</label>
                    <input 
                        type="text" 
                        name="responsavel" 
                        class="form-control" 
                        value="{{ old('responsavel') }}" 
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
                        value="{{ old('telefone') }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">WhatsApp</label>
                    <input 
                        type="text" 
                        name="whatsapp" 
                        class="form-control" 
                        value="{{ old('whatsapp') }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">E-mail</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        value="{{ old('email') }}"
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
                        value="{{ old('cidade', 'Ituporanga') }}" 
                        required
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Bairro / Localidade</label>
                    <input 
                        type="text" 
                        name="bairro" 
                        class="form-control" 
                        value="{{ old('bairro') }}"
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Endereço</label>
                    <input 
                        type="text" 
                        name="endereco" 
                        class="form-control" 
                        value="{{ old('endereco') }}"
                    >
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição da propriedade</label>
                <textarea 
                    name="descricao" 
                    class="form-control" 
                    rows="5"
                    placeholder="Descreva a propriedade, sua história, localização, produção e diferenciais."
                >{{ old('descricao') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Imagem da propriedade</label>
                <input 
                    type="file" 
                    name="imagem" 
                    class="form-control"
                    accept="image/*"
                >
                <small class="text-muted">Formatos aceitos: JPG, PNG, JPEG. Tamanho máximo: 2MB.</small>
            </div>

            <button type="submit" class="btn btn-success">
                Salvar propriedade
            </button>

            <a href="{{ route('admin.propriedades.index') }}" class="btn btn-outline-secondary">
                Cancelar
            </a>
        </form>
    </div>
</div>
@endsection