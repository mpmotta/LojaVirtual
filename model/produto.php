<?php
require_once('Conexao.php');

class Produto {
    private $conn;

    public function __construct() {
        $database = new Conexao();
        $this->conn = $database->getConnection();
    }

    // 1. Listar tudo (Home)
    public function listarTodos() {
        $query = "SELECT * FROM produtos ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Listar por Categoria
    public function listarPorCategoria($categoria) {
        $query = "SELECT * FROM produtos WHERE categoria = :cat ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':cat', $categoria);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Buscar um produto específico (Detalhes)
    public function buscarPorId($id) {
        $query = "SELECT * FROM produtos WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Buscar por Nome (Barra de Pesquisa)
    public function buscarPorNome($termo) {
        $query = "SELECT * FROM produtos WHERE nome LIKE :termo ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':termo', "%" . $termo . "%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>