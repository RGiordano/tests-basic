<?php

namespace App\Services;

use App\Models\Carrinho;

class CorreiosService implements TransportadoraInterface
{
    public function calculaFrete(Carrinho $carrinho, string $cep): float
    {
        // ToDo implement
        return INF;
    }
}
