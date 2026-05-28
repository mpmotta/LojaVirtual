<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\ProdutoController;
use App\Model\Produto;

class ProdutoControllerTest extends TestCase
{
    // --- TESTES DO CONTROLLER ---

    public function testConsultaRetornaArray()
    {
        $controller = new ProdutoController();
        $this->assertIsArray($controller->consulta());
    }

    // --- TESTES DO MODEL (PRODUTO) ---

    public function testProdutoPodeSerInstanciado()
    {
        $produto = new Produto();
        $this->assertInstanceOf(Produto::class, $produto);
    }

    public function testListarTodosRetornaArray()
    {
        $produto = new Produto();
        $this->assertIsArray($produto->listarTodos());
    }

    public function testListarPorCategoriaRetornaArray()
    {
        $produto = new Produto();
        $resultado = $produto->listarPorCategoria('Eletrônicos');
        $this->assertIsArray($resultado);
    }

    public function testBuscarPorIdRetornaArrayOuFalse()
    {
        $produto = new Produto();
        $resultado = $produto->buscarPorId(999999);
        $this->assertIsArray($resultado);
    }

    public function testBuscarPorNomeRetornaArray()
    {
        $produto = new Produto();
        $resultado = $produto->buscarPorNome('teste');
        $this->assertIsArray($resultado);
    }

    // --- TESTE DE SEGURANÇA (SQL INJECTION) ---

    public function testBuscaPorNomeComCaracteresMaliciosos()
    {
        $produto = new Produto();
        $resultado = $produto->buscarPorNome("' OR 1=1 --");
        $this->assertIsArray($resultado);
    }
}
