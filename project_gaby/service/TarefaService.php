<?php

class TarefaService {
    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa = null) {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir() {
        $query = 'INSERT INTO tb_tarefas (tarefa, id_status, data_cadastrado) VALUES (:tarefa, :id_status, NOW())';
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));

        return $stmt->execute();
    }

    public function listar() {
        $query = 'SELECT * FROM tb_tarefas ORDER BY data_cadastrado DESC';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $query = 'SELECT * FROM tb_tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar() {
        $query = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        $stmt->execute();
    }

    public function deletar($id) {
        $query = 'DELETE FROM tb_tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
?>