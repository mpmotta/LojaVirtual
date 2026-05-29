<?php

namespace App\Controller;

use App\Model\Produto;

class ProdutoController
{
    private $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    public function consulta()
    {
        return $this->produtMmodel->listar_todos();
    }

    public function consultaPorCategoria($categoria)
    {
        return $this->produtoModel->listarPorCategoria($categoria);
    }

    public function buscarPorId($id)
    {
        return $this->produtoModel->buscarPorId($id);
    }

    public function buscarPorNome($termo)
    {
        return $this->produtoModel->buscarPorNome($termo);
    }
}
