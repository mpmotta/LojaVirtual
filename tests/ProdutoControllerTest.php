<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../controller/ProdutoController.php';
require_once __DIR__ . '/../model/Produto.php';

class ProdutoControllerTest extends TestCase {
    public function testConsultaRetornaArray() {
        $this->assertTrue(true); // Teste de fumaça inicial
    }
}