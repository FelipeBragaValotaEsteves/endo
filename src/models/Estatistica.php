<?php
require_once '../config/db.php';

class Estatistica
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($gols, $assistencias, $cartoes_amarelos, $cartoes_vermelhos, $jogador_id)
    {
        $sql = "INSERT INTO tb_estatisticas (gols, assistencias, cartoes_amarelos, cartoes_vermelhos, jogador_id) VALUES (:gols, :assistencias, :cartoes_amarelos, :cartoes_vermelhos, :jogador_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':gols', $gols);
        $stmt->bindParam(':assistencias', $assistencias);
        $stmt->bindParam(':cartoes_amarelos', $cartoes_amarelos);
        $stmt->bindParam(':cartoes_vermelhos', $cartoes_vermelhos);
        $stmt->bindParam(':jogador_id', $jogador_id);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT id_estatistica AS id, gols, assistencias, cartoes_amarelos, cartoes_vermelhos, jogador_id FROM tb_estatisticas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByJogador($id)
    {
        $sql = "SELECT * FROM tb_estatisticas WHERE id_estatistica = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM tb_estatisticas WHERE jogador_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $gols, $assistencias, $cartoes_amarelos, $cartoes_vermelhos, $jogador_id)
    {
        $sql = "UPDATE tb_estatisticas SET gols = :gols, assistencias = :assistencias, cartoes_amarelos = :cartoes_amarelos, cartoes_vermelhos = :cartoes_vermelhos, jogador_id = :jogador_id WHERE id_estatistica = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':gols', $gols);
        $stmt->bindParam(':assistencias', $assistencias);
        $stmt->bindParam(':cartoes_amarelos', $cartoes_amarelos);
        $stmt->bindParam(':cartoes_vermelhos', $cartoes_vermelhos);
        $stmt->bindParam(':jogador_id', $jogador_id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tb_estatisticas WHERE id_estatistica = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
