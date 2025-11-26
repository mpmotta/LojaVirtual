<?php
// Importa o Model (ajuste o caminho se necessário)
require_once('../model/Produto.php');

class ProdutoController {
    private $produtoModel;

    public function __construct() {
        $this->produtoModel = new Produto();
    }

    public function consulta() {
        return $this->produtoModel->listarTodos();
    }

    public function consultaPorCategoria($categoria) {
        return $this->produtoModel->listarPorCategoria($categoria);
    }

    public function buscarPorId($id) {
        return $this->produtoModel->buscarPorId($id);
    }

    public function buscarPorNome($termo) {
        return $this->produtoModel->buscarPorNome($termo);
    }
}
?>