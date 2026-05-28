<?php
class Conexao {
    private $host = "localhost";
    private $db_name = "loja";
    private $username = "root";
    private $password = "usbw";
    public $conn;

    public function getConnection() {
        // A trava de segurança que impede o erro no GitHub Actions
        if (getenv('GITHUB_ACTIONS')) {
            return null;
        }

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
