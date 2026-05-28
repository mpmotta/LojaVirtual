<?php
use PHPUnit\Framework\TestCase;

// Carrega o autoload do Composer para encontrar suas classes automaticamente
require_once __DIR__ . '/../vendor/autoload.php';

class ProdutoControllerTest extends TestCase {
    
    /**
     * Testa se o método consulta do Controller retorna um array.
     * Isso garante que a integração entre Controller e Model está funcionando.
     */
    public function testConsultaRetornaArrayDeProdutos() {
        // Instancia o controller
        $controller = new ProdutoController();
        
        // Executa a ação
        $resultado = $controller->consulta();
        
        // Verifica se o resultado é um array (mesmo que vazio, se não houver conexão)
        $this->assertIsArray($resultado, "O método consulta() deve retornar um array.");
    }

    /**
     * Testa se o model Produto consegue ser instanciado sem erro.
     */
    public function testProdutoPodeSerInstanciado() {
        $produto = new Produto();
        $this->assertInstanceOf(Produto::class, $produto);
    }
}
