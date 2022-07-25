<?php

namespace App\Services;

use App\Models\Carrinho;
use App\Models\Produto;

/**
 * Esta classe utiliza diretamente model para facilitar - idealmente utilizar Repository
 */
class CarrinhoService
{
    private TransportadoraInterface $transportadora;

    public function __construct(TransportadoraInterface $transportadora)
    {
        $this->transportadora = $transportadora;
    }

    public function addProduto(Carrinho $carrinho, Produto $produto, int $quantidade = 1)
    {
        $produtoSacola = $carrinho->produtos()->firstWhere('id', $produto->id);
        if ($produtoSacola) {
            $carrinho->produtos()->updateExistingPivot($produto->id, [
                'quantidade' => $produtoSacola->pivot->quantidade + $quantidade,
            ]);
        } else {
            $carrinho->produtos()->attach($produto->id, ['quantidade' => $quantidade]);
        }
    }

    public function removeProduto(Carrinho $carrinho, Produto $produto, int $quantidade = 1)
    {
        $produtoSacola = $carrinho->produtos()->firstWhere('id', $produto->id);
        if ($produtoSacola && $produtoSacola->pivot->quantidade <= $quantidade) {
            $carrinho->produtos()->detach($produto->id);
        } elseif ($produtoSacola) {
            $carrinho->produtos()->updateExistingPivot($produto->id, [
                'quantidade' => $produtoSacola->pivot->quantidade - $quantidade,
            ]);
        }
    }

    public function clearProdutos(Carrinho $carrinho)
    {
        $carrinho->produtos()->sync([]);
    }

    public function getTotal(Carrinho $carrinho, string $cep): float
    {
        return $this->getSubtotal($carrinho) + $this->getFrete($carrinho, $cep);
    }

    public function getSubtotal(Carrinho $carrinho): float
    {
        return $carrinho->produtos()->get()->sum(function ($produto) {
            return $produto->valor * ($produto->pivot->quantidade ?? 1);
        });
    }

    public function getFrete(Carrinho $carrinho, string $cep): float
    {
        if ($this->getSubtotal($carrinho) >= 100.00) {
            return 0.00;
        }
        return $this->transportadora->calculaFrete($carrinho, $cep);
    }
}
