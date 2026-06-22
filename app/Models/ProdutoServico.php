<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutoServico extends Model
{
    protected $table = 'produtos_servicos';

    protected $fillable = [
        'propriedade_id',
        'categoria_id',
        'tipo',
        'nome',
        'descricao',
        'preco_estimado',
        'unidade',
        'disponibilidade',
        'imagem',
        'ativo',
    ];

    public function propriedade(): BelongsTo
    {
        return $this->belongsTo(Propriedade::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
