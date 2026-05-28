<?php

namespace App\Controller;

use App\Model\Produto;

class CarrinhoController
{
    private $produtoModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->produtoModel = new Produto();

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    public function adicionar($id)
    {
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]++;
        } else {
            $_SESSION['carrinho'][$id] = 1;
        }
    }

    public function remover($id)
    {
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    public function listarItens()
    {
        $itensDetalhados = [];
        $total = 0;

        foreach ($_SESSION['carrinho'] as $id => $quantidade) {
            $produto = $this->produtoModel->buscarPorId($id);
            if ($produto) {
                $produto['quantidade'] = $quantidade;
                $produto['subtotal'] = $produto['valor'] * $quantidade;
                $total += $produto['subtotal'];
                $itensDetalhados[] = $produto;
            }
        }

        return ['itens' => $itensDetalhados, 'total' => $total];
    }
}
