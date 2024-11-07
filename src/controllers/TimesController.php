<?php
require_once '../models/Time.php';

class TimesController
{
    private $time;

    public function __construct($db)
    {
        $this->time = new Time($db);
    }

    public function list()
    {
        try {
            $times = $this->time->list();
            echo json_encode($times);
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao listar os times."]);
        }
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nome)) {
            try {
                $this->time->create($data->nome);
                http_response_code(201);
                echo json_encode(["message" => "Time criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar o time."]);
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
                $time = $this->time->getById($id);
                if ($time) {
                    echo json_encode($time);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Time não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o time."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->nome)) {
            try {
                $count = $this->time->update($id, $data->nome);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Time atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o time."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o time."]);
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
                $count = $this->time->delete($id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Time deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o time."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o time."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}