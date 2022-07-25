<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Usuario $usuario
 * @property Collection $produtos
 */
class Carrinho extends Model
{
    use HasFactory;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class)->withPivot(['quantidade']);
    }
}
