<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\ProdutoServico;
use App\Models\Propriedade;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
{
    $categorias = Categoria::orderBy('nome')->get();

    $propriedades = Propriedade::where('ativo', true)
        ->latest()
        ->take(6)
        ->get();

    $produtos = ProdutoServico::with(['propriedade', 'categoria'])
        ->where('ativo', true)
        ->latest()
        ->take(8)
        ->get();

    return view('public.home', compact('categorias', 'propriedades', 'produtos'));
}

    public function propriedades(Request $request)
    {
        $busca = $request->input('busca');
        $cidade = $request->input('cidade');

        $propriedades = Propriedade::where('ativo', true)
            ->when($busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('nome', 'like', "%{$busca}%")
                        ->orWhere('responsavel', 'like', "%{$busca}%")
                        ->orWhere('descricao', 'like', "%{$busca}%");
                });
            })
            ->when($cidade, function ($query, $cidade) {
                $query->where('cidade', 'like', "%{$cidade}%");
            })
            ->latest()
            ->paginate(9);

        return view('public.propriedades', compact('propriedades', 'busca', 'cidade'));
    }

    public function showPropriedade(Propriedade $propriedade)
    {
        abort_if(!$propriedade->ativo, 404);

        $propriedade->load(['produtosServicos.categoria']);

        return view('public.propriedade-show', compact('propriedade'));
    }

    public function produtos(Request $request)
    {
        $busca = $request->input('busca');
        $tipo = $request->input('tipo');
        $categoriaId = $request->input('categoria_id');

        $categorias = Categoria::orderBy('nome')->get();

        $produtos = ProdutoServico::with(['propriedade', 'categoria'])
            ->where('ativo', true)
            ->when($busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('nome', 'like', "%{$busca}%")
                        ->orWhere('descricao', 'like', "%{$busca}%");
                });
            })
            ->when($tipo, function ($query, $tipo) {
                $query->where('tipo', $tipo);
            })
            ->when($categoriaId, function ($query, $categoriaId) {
                $query->where('categoria_id', $categoriaId);
            })
            ->latest()
            ->paginate(12);

        return view('public.produtos', compact('produtos', 'categorias', 'busca', 'tipo', 'categoriaId'));
    }
}