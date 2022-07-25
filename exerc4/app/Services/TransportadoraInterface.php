<?php

namespace App\Services;

use App\Models\Carrinho;

interface TransportadoraInterface
{
    public function calculaFrete(Carrinho $carrinho, string $cep): float;
}
