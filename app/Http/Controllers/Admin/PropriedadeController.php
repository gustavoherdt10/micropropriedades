<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Propriedade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PropriedadeController extends Controller
{
    public function index()
    {
        $propriedades = Propriedade::where('user_id', auth::id())
            ->latest()
            ->paginate(10);

        return view('admin.propriedades.index', compact('propriedades'));
    }

    public function create()
    {
        return view('admin.propriedades.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:150'],
            'responsavel' => ['required', 'string', 'max:150'],
            'telefone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'cidade' => ['required', 'string', 'max:100'],
            'bairro' => ['nullable', 'string', 'max:120'],
            'endereco' => ['nullable', 'string', 'max:180'],
            'descricao' => ['nullable', 'string'],
            'imagem' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('propriedades', 'public');
        }

        $dados['user_id'] = auth::id();
        $dados['ativo'] = true;

        Propriedade::create($dados);

        return redirect()
            ->route('admin.propriedades.index')
            ->with('success', 'Propriedade cadastrada com sucesso.');
    }

    public function show(Propriedade $propriedade)
    {
        $this->autorizarUsuario($propriedade);

        return view('admin.propriedades.show', compact('propriedade'));
    }

    public function edit(Propriedade $propriedade)
    {
        $this->autorizarUsuario($propriedade);

        return view('admin.propriedades.edit', compact('propriedade'));
    }

    public function update(Request $request, Propriedade $propriedade)
    {
        $this->autorizarUsuario($propriedade);

        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:150'],
            'responsavel' => ['required', 'string', 'max:150'],
            'telefone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'cidade' => ['required', 'string', 'max:100'],
            'bairro' => ['nullable', 'string', 'max:120'],
            'endereco' => ['nullable', 'string', 'max:180'],
            'descricao' => ['nullable', 'string'],
            'imagem' => ['nullable', 'image', 'max:2048'],
            'ativo' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('imagem')) {
            if ($propriedade->imagem) {
                Storage::disk('public')->delete($propriedade->imagem);
            }

            $dados['imagem'] = $request->file('imagem')->store('propriedades', 'public');
        }

        $dados['ativo'] = $request->boolean('ativo');

        $propriedade->update($dados);

        return redirect()
            ->route('admin.propriedades.index')
            ->with('success', 'Propriedade atualizada com sucesso.');
    }

    public function destroy(Propriedade $propriedade)
    {
        $this->autorizarUsuario($propriedade);

        if ($propriedade->imagem) {
            Storage::disk('public')->delete($propriedade->imagem);
        }

        $propriedade->delete();

        return redirect()
            ->route('admin.propriedades.index')
            ->with('success', 'Propriedade excluída com sucesso.');
    }

    private function autorizarUsuario(Propriedade $propriedade): void
    {
        abort_unless($propriedade->user_id === auth::id(), 403);
    }
}