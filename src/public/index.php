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
$router->add('DELETE', '/jogadores/{id}', [$jogadoresController, 'delete']);
$router->add('PUT', '/jogadores/{id}', [$jogadoresController, 'update']);

$router->add('GET', '/times', [$timesController, 'list']);
$router->add('GET', '/times/{id}', [$timesController, 'getById']);
$router->add('POST', '/times', [$timesController, 'create']);
$router->add('DELETE', '/times/{id}', [$timesController, 'delete']);
$router->add('PUT', '/times/{id}', [$timesController, 'update']);

$router->add('GET', '/estatisticas', [$jogadoresController, 'list']);
$router->add('GET', '/estatisticas/{id}', [$jogadoresController, 'getById']);
$router->add('POST', '/estatisticas', [$jogadoresController, 'create']);
$router->add('DELETE', '/estatisticas/{id}', [$jogadoresController, 'delete']);
$router->add('PUT', '/estatisticas/{id}', [$jogadoresController, 'update']);


$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);


$requestedPath = preg_replace('/\/index\.php/', '', $requestedPath);

$router->dispatch($requestedPath);