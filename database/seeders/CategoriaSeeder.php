<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Produto unitário',
            'Produto em caixa',
            'Produto por kg',
            'Produto colonial',
            'Artesanato',
            'Kit / cesta',
            'Serviço de passeio',
            'Serviço de hospedagem',
            'Serviço de alimentação',
            'Experiência rural',
            'Outro',
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate([
                'nome' => $categoria,
            ]);
        }
    }
}