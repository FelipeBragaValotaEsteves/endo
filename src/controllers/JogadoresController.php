<?php
require_once '../models/Jogador.php';

class JogadoresController
{
    private $jogador;

    public function __construct($db)
    {
        $this->jogador = new Jogador($db);
    }

    public function list()
    {
        $jogadores = $this->jogador->list();
        echo json_encode($jogadores);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nome) && isset($data->posicao) && isset($data->data_nascimento) && isset($data->time_id)) {
            try {
                $this->jogador->create($data->nome, $data->posicao, $data->data_nascimento, $data->time_id);

                http_response_code(response_code: 200);
                echo json_encode(["message" => "Jogador criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar o jogador."]);
            }
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $jogador = $this->jogador->getById($id);
                if ($jogador) {
                    echo json_encode($jogador);
                } else {
                    http_response_code(200);
                    echo json_encode(["message" => "Jogador não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o jogador."]);
            }
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->nome) && isset($data->posicao) && isset($data->data_nascimento) && isset($data->time_id)) {
            try {
                $count = $this->jogador->update($id, $data->nome, $data->posicao, $data->data_nascimento, $data->time_id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Jogador atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o jogador."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o jogador."]);
            }
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete($id)
    {
        if (isset($id)) {
            try {
                $count = $this->jogador->delete($id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Jogador deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o jogador."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o jogador."]);
            }
        } else {
            http_response_code(200);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
