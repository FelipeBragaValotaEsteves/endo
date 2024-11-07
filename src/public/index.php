<?php
require_once '../config/db.php';
require_once '../controllers/JogadoresController.php';
require_once '../controllers/EstatisticasController.php';
require_once '../controllers/TimesController.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$jogadoresController = new JogadoresController($pdo);
$timesController = new TimesController($pdo);
$estatisticasController = new EstatisticasController($pdo);

$router->add('GET', '/jogadores', [$jogadoresController, 'list']);
$router->add('GET', '/jogadores/{id}', [$jogadoresController, 'getById']);
$router->add('POST', '/jogadores', [$jogadoresController, 'create']);
$router->add('PUT', '/jogadores/{id}', [$jogadoresController, 'update']);
$router->add('DELETE', '/jogadores/{id}', [$jogadoresController, 'delete']);

$router->add('GET', '/times', [$timesController, 'list']);
$router->add('GET', '/times/{id}', [$timesController, 'getById']);
$router->add('POST', '/times', [$timesController, 'create']);
$router->add('PUT', '/times/{id}', [$timesController, 'update']);
$router->add('DELETE', '/times/{id}', [$timesController, 'delete']);

$router->add('GET', '/estatisticas', [$estatisticasController, 'list']);
$router->add('GET', '/estatisticas/{id}', [$estatisticasController, 'getById']);
$router->add('POST', '/estatisticas', [$estatisticasController, 'create']);
$router->add('PUT', '/estatisticas/{id}', [$estatisticasController, 'update']);
$router->add('DELETE', '/estatisticas/{id}', [$estatisticasController, 'delete']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$baseDir = str_replace('/index.php', '', $_SERVER["SCRIPT_NAME"]);
$requestedPath = '/' . trim(str_replace($baseDir, '', $requestedPath), '/');

$router->dispatch($requestedPath);
