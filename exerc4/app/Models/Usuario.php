<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $nome
 * @property string $cep
 * @property Collection $carrinhos
 */
class Usuario extends Model
{
    use HasFactory;

    public function carrinhos(): HasMany
    {
        return $this->hasMany(Carrinho::class);
    }
}
