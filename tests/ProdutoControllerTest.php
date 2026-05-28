<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class ProdutoControllerTest extends TestCase {

    // --- TESTES DO CONTROLLER ---

    public function testConsultaRetornaArray() {
        $controller = new ProdutoController();
        $this->assertIsArray($controller->consulta());
    }

    // --- TESTES DO MODEL (PRODUTO) ---

    public function testProdutoPodeSerInstanciado() {
        $produto = new Produto();
        $this->assertInstanceOf(Produto::class, $produto);
    }

    public function testListarTodosRetornaArray() {
        $produto = new Produto();
        $this->assertIsArray($produto->listarTodos());
    }

    public function testListarPorCategoriaRetornaArray() {
        $produto = new Produto();
        // Testando com uma categoria genérica
        $resultado = $produto->listarPorCategoria('Eletrônicos');
        $this->assertIsArray($resultado);
    }

    public function testBuscarPorIdRetornaArrayOuFalse() {
        $produto = new Produto();
        // Testando com um ID inválido (deve retornar array vazio ou false conforme seu código)
        $resultado = $produto->buscarPorId(999999);
        $this->assertNotIsInstanceOf(PDOStatement::class, $resultado);
    }

    public function testBuscarPorNomeRetornaArray() {
        $produto = new Produto();
        $resultado = $produto->buscarPorNome('teste');
        $this->assertIsArray($resultado);
    }

    // --- TESTE DE SEGURANÇA (SQL INJECTION) ---

    public function testBuscaPorNomeComCaracteresMaliciosos() {
        $produto = new Produto();
        // Verifica se o sistema processa strings com aspas sem quebrar
        $resultado = $produto->buscarPorNome("' OR 1=1 --");
        $this->assertIsArray($resultado);
    }
}
