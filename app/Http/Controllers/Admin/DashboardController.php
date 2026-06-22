<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdutoServico;
use App\Models\Propriedade;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPropriedades = Propriedade::where('user_id', auth::id())->count();

        $totalProdutos = ProdutoServico::whereHas('propriedade', function ($query) {
            $query->where('user_id', auth::id());
        })->count();

        return view('admin.dashboard', compact('totalPropriedades', 'totalProdutos'));
    }
}