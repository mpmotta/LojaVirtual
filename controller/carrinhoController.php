<?php
// controller/carrinhoController.php
require_once('../model/Produto.php');

// Inicia a sessão se ainda não existir
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CarrinhoController {
    private $produtoModel;

    public function __construct() {
        $this->produtoModel = new Produto();
        
        // Se o carrinho não existe na sessão, cria um array vazio
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    // Adiciona item ao carrinho
    public function adicionar($id) {
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]++; // Aumenta quantidade
        } else {
            $_SESSION['carrinho'][$id] = 1; // Adiciona novo
        }
    }

    // Remove item do carrinho
    public function remover($id) {
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    // Lista os produtos completos para exibir na tela
    public function listarItens() {
        $itensDetalhados = [];
        $total = 0;

        foreach ($_SESSION['carrinho'] as $id => $quantidade) {
            $produto = $this->produtoModel->buscarPorId($id);
            if ($produto) {
                // Adiciona a quantidade ao objeto do produto
                $produto['quantidade'] = $quantidade;
                $produto['subtotal'] = $produto['valor'] * $quantidade;
                $total += $produto['subtotal'];
                $itensDetalhados[] = $produto;
            }
        }

        return ['itens' => $itensDetalhados, 'total' => $total];
    }
}
?>