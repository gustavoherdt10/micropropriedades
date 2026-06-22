<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Propriedade extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'responsavel',
        'telefone',
        'whatsapp',
        'email',
        'cidade',
        'bairro',
        'endereco',
        'descricao',
        'imagem',
        'ativo',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produtosServicos(): HasMany
    {
        return $this->hasMany(ProdutoServico::class);
    }
}
