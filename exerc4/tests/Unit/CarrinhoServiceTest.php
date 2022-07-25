<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;

use App\Models\Carrinho;
use App\Models\Produto;
use App\Models\Usuario;
use App\Services\CarrinhoService;
use App\Services\CorreiosService;

class CarrinhoServiceTest extends TestCase
{
    public function testGetFreteLessThan100()
    {
        $mock = Mockery::mock(CorreiosService::class);
        $mock->shouldReceive('calculaFrete')->once()->andReturn(10.00);
        $carrinhoService = new CarrinhoService($mock);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create(['valor' => 10.00]);
        $carrinhoService->addProduto($carrinho, $produto, 1);
        $this->assertEquals(
            10.00,
            $carrinhoService->getFrete($carrinho, $carrinho->usuario->cep)
        );
    }

    public function testGetFreteMoreThan100()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produtoTShirt = Produto::factory()->create([
            'nome' => 'camiseta',
            'valor' => 38.90,
        ]);
        $produtoJeans = Produto::factory()->create([
            'nome' => 'calça jeans',
            'valor' => 149.90,
        ]);
        $carrinhoService->addProduto($carrinho, $produtoTShirt, 1);
        $carrinhoService->addProduto($carrinho, $produtoJeans, 1);
        $this->assertEquals(
            0.00,
            $carrinhoService->getFrete($carrinho, $carrinho->usuario->cep)
        );
    }

    public function testGetFreteEqualsTo100()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create([
            'nome' => 'camiseta',
            'valor' => 100.00,
        ]);
        $carrinhoService->addProduto($carrinho, $produto, 1);
        $this->assertEquals(
            0.00,
            $carrinhoService->getFrete($carrinho, $carrinho->usuario->cep)
        );
    }

    public function testGetSubTotalEmptyCart()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $this->assertEquals(
            0.00,
            $carrinhoService->getSubtotal($carrinho)
        );
    }

    public function testGetSubTotalMoreThanOneProduct()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produtoCem = Produto::factory()->create([
            'valor' => 100.00,
        ]);
        $produtoDuzentos = Produto::factory()->create([
            'valor' => 200.00,
        ]);
        $carrinhoService->addProduto($carrinho, $produtoCem, 1);
        $carrinhoService->addProduto($carrinho, $produtoDuzentos, 1);
        $this->assertEquals(
            300.00,
            $carrinhoService->getSubtotal($carrinho)
        );
    }

    public function testGetSubTotalMoreThanOneQuantity()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produtoCem = Produto::factory()->create([
            'valor' => 100.00,
        ]);
        $carrinhoService->addProduto($carrinho, $produtoCem, 2);
        $this->assertEquals(
            200.00,
            $carrinhoService->getSubtotal($carrinho)
        );
    }

    public function testGetTotal()
    {
        $mock = Mockery::mock(CorreiosService::class);
        $mock->shouldReceive('calculaFrete')->once()->andReturn(10.00);
        $carrinhoService = new CarrinhoService($mock);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create([
            'valor' => 40.00,
        ]);
        $carrinhoService->addProduto($carrinho, $produto, 2);
        $this->assertEquals(
            90.00,
            $carrinhoService->getTotal($carrinho, $carrinho->usuario->cep)
        );
    }

    // add carrinho
    public function testAddProduto()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create();
        $carrinhoService->addProduto($carrinho, $produto, 1);
        $this->assertEquals(
            1,
            $carrinho->produtos()->count()
        );
    }

    public function testAddProdutoQuantity()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create();
        $carrinhoService->addProduto($carrinho, $produto, 1);
        $carrinhoService->addProduto($carrinho, $produto, 3);
        $this->assertEquals(
            1,
            $carrinho->produtos()->count()
        );
        $this->assertEquals(
            4,
            $carrinho->produtos()->first()->pivot->quantidade
        );
    }

    public function testRemoveProduto()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create();
        $carrinhoService->addProduto($carrinho, $produto, 1);
        $carrinhoService->removeProduto($carrinho, $produto, 1);
        $this->assertEquals(
            0,
            $carrinho->produtos()->count()
        );
    }

    public function testRemoveProdutoQuantity()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto = Produto::factory()->create();
        $carrinhoService->addProduto($carrinho, $produto, 3);
        $carrinhoService->removeProduto($carrinho, $produto, 1);
        $this->assertEquals(
            1,
            $carrinho->produtos()->count()
        );
        $this->assertEquals(
            2,
            $carrinho->produtos()->first()->pivot->quantidade
        );
    }

    // zerar carrinho
    public function testClearProdutos()
    {
        $carrinhoService = app(CarrinhoService::class);
        $carrinho = Carrinho::factory()->forUsuario()->create();
        $produto1 = Produto::factory()->create();
        $produto2 = Produto::factory()->create();
        $carrinhoService->addProduto($carrinho, $produto1, 3);
        $carrinhoService->addProduto($carrinho, $produto2, 2);
        $carrinhoService->clearProdutos($carrinho);
        $this->assertEquals(
            0,
            $carrinho->produtos()->count()
        );
    }
}
