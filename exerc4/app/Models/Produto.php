<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $nome
 * @property float $valor
 *
 * @property Collection $carrinhos
 */
class Produto extends Model
{
    use HasFactory;

    public function carrinhos(): BelongsToMany
    {
        return $this->belongsToMany(Carrinho::class, 'carrinho_produto');
    }
}
