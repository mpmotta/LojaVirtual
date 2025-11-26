<?php
// model/Conexao.php
class Conexao {
    private $host = "localhost";
    private $db_name = "loja"; // Coloque o nome do seu banco
    private $username = "root";   // Seu usuário
    private $password = "";       // Sua senha
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>