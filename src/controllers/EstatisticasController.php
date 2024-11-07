<?php
require_once '../models/Estatistica.php';

class EstatisticasController
{
    private $estatistica;

    public function __construct($db)
    {
        $this->estatistica = new Estatistica($db);
    }

    public function list()
    {
        $estatisticas = $this->estatistica->list();
        echo json_encode($estatisticas);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->gols) && isset($data->assistencias) && isset($data->cartoes_amarelos) && isset($data->cartoes_vermelhos) && isset($data->jogador_id)) {
            try {
                $this->estatistica->create($data->gols, $data->assistencias, $data->cartoes_amarelos, $data->cartoes_vermelhos, $data->jogador_id);

                http_response_code(201);
                echo json_encode(["message" => "Estatística criada com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar a estatística."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $estatistica = $this->estatistica->getById($id);
                if ($estatistica) {
                    echo json_encode($estatistica);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Estatística não encontrada."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar a estatística."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->gols) && isset($data->assistencias) && isset($data->cartoes_amarelos) && isset($data->cartoes_vermelhos) && isset($data->jogador_id)) {
            try {
                $count = $this->estatistica->update($id, $data->gols, $data->assistencias, $data->cartoes_amarelos, $data->cartoes_vermelhos, $data->jogador_id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Estatística atualizada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar a estatística."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar a estatística."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete($id)
    {
        if (isset($id)) {
            try {
                $count = $this->estatistica->delete($id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Estatística deletada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar a estatística."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar a estatística."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
