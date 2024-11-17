<?php

class Conexao {
    private $host = 'localhost';
    private $dbname = 'my_list_taref';
    private $username = 'root';
    private $password = '';

    public function conectar() {
        try {
            $conexao = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            return $conexao;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            exit;
        }
    }
}
?>