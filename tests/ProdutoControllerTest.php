<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../vendor/autoload.php';

class ProdutoControllerTest extends TestCase {
    public function testConsultaRetornaArray() {
        $controller = new ProdutoController();
        $this->assertIsArray($controller->consulta());
    }
}
