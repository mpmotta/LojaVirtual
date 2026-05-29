<?php

namespace App\Model;

use PDO;
use App\Model\Conexao;

class Produto
{
    private $conn;

    public function __construct()
    {
        $database = new Conexao();
        $this->conn = $database->getConnection();
    }

    public function listarTudo()
    {
        if ($this->conn === null) {
            return [];
        }
        $query = "SELECT * FROM produtos ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorCategoria($categoria)
    {
        if ($this->conn === null) {
            return [];
        }
        $query = "SELECT * FROM produtos WHERE categoria = :cat ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':cat', $categoria);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        if ($this->conn === null) {
            return [];
        }
        $query = "SELECT * FROM produtos WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorNome($termo)
    {
        if ($this->conn === null) {
            return [];
        }
        $query = "SELECT * FROM produtos WHERE nome LIKE :termo ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':termo', "%" . $termo . "%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
