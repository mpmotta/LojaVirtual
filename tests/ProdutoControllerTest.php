<?php
use PHPUnit\Framework\TestCase;

// Carrega as ferramentas do Composer (incluindo o PHPUnit e seu autoload)
require_once __DIR__ . '/../vendor/autoload.php';

class ProdutoControllerTest extends TestCase {
    public function testConsultaRetornaArray() {
        // Como o classmap foi configurado, a classe ProdutoController 
        // será carregada automaticamente pelo autoload
        $controller = new ProdutoController();
        $this->assertIsArray($controller->consulta());
    }
}
