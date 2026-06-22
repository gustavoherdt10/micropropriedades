<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\ProdutoServico;
use App\Models\Propriedade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProdutoServicoController extends Controller
{
    public function index()
    {
        $produtos = ProdutoServico::with(['propriedade', 'categoria'])
            ->whereHas('propriedade', function ($query) {
                $query->where('user_id', auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $propriedades = Propriedade::where('user_id', auth::id())
            ->orderBy('nome')
            ->get();

        $categorias = Categoria::orderBy('nome')->get();

        return view('admin.produtos.create', compact('propriedades', 'categorias'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'propriedade_id' => [
                'required',
                Rule::exists('propriedades', 'id')->where('user_id', auth::id()),
            ],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
            'tipo' => ['required', Rule::in(['produto', 'servico'])],
            'nome' => ['required', 'string', 'max:150'],
            'descricao' => ['nullable', 'string'],
            'preco_estimado' => ['nullable', 'numeric', 'min:0'],
            'unidade' => ['nullable', 'string', 'max:50'],
            'disponibilidade' => ['nullable', 'string', 'max:120'],
            'imagem' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $dados['ativo'] = true;

        ProdutoServico::create($dados);

        return redirect()
            ->route('admin.produtos.index')
            ->with('success', 'Produto ou serviço cadastrado com sucesso.');
    }

    public function show(ProdutoServico $produto)
    {
        $this->autorizarUsuario($produto);

        return view('admin.produtos.show', compact('produto'));
    }

    public function edit(ProdutoServico $produto)
    {
        $this->autorizarUsuario($produto);

        $propriedades = Propriedade::where('user_id', auth::id())
            ->orderBy('nome')
            ->get();

        $categorias = Categoria::orderBy('nome')->get();

        return view('admin.produtos.edit', compact('produto', 'propriedades', 'categorias'));
    }

    public function update(Request $request, ProdutoServico $produto)
    {
        $this->autorizarUsuario($produto);

        $dados = $request->validate([
            'propriedade_id' => [
                'required',
                Rule::exists('propriedades', 'id')->where('user_id', auth::id()),
            ],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
            'tipo' => ['required', Rule::in(['produto', 'servico'])],
            'nome' => ['required', 'string', 'max:150'],
            'descricao' => ['nullable', 'string'],
            'preco_estimado' => ['nullable', 'numeric', 'min:0'],
            'unidade' => ['nullable', 'string', 'max:50'],
            'disponibilidade' => ['nullable', 'string', 'max:120'],
            'imagem' => ['nullable', 'image', 'max:2048'],
            'ativo' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('imagem')) {
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $dados['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $dados['ativo'] = $request->boolean('ativo');

        $produto->update($dados);

        return redirect()
            ->route('admin.produtos.index')
            ->with('success', 'Produto ou serviço atualizado com sucesso.');
    }

    public function destroy(ProdutoServico $produto)
    {
        $this->autorizarUsuario($produto);

        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect()
            ->route('admin.produtos.index')
            ->with('success', 'Produto ou serviço excluído com sucesso.');
    }

    private function autorizarUsuario(ProdutoServico $produto): void
    {
        abort_unless($produto->propriedade->user_id === auth::id(), 403);
    }
}