<?php
require_once '../config/db.php';

class Jogador
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($nome, $posicao, $data_nascimento, $timeId)
    {
        $sql = "INSERT INTO tb_jogadores (nome, posicao, data_nascimento, time_id) VALUES (:nome, :posicao, :data_nascimento, :timeId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':posicao', $posicao);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':timeId', $timeId);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT id_jogador AS id, nome, posicao, data_nascimento, time_id FROM tb_jogadores";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM tb_jogadores WHERE id_jogador = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $posicao, $data_nascimento, $timeId)
    {
        $sql = "UPDATE tb_jogadores SET nome = :nome, posicao = :posicao, data_nascimento = :data_nascimento, time_id = :timeId WHERE id_jogador = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':posicao', $posicao);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':timeId', $timeId);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tb_jogadores WHERE id_jogador = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
