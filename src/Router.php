<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
class Router
{
    private $routes = [];

    public function add($method, $path, $callback)
    {
        $path = preg_replace('/\{(\w+)\}/', '(\d+)', $path);
        $this->routes[] = [
            'method' => $method,
            'path' => "#^" . $path . "$#",
            'callback' => $callback
        ];
    }

    public function dispatch($requestedPath)
    {
        $requestedMethod = $_SERVER["REQUEST_METHOD"];

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && preg_match($route['path'], $requestedPath, $matches)) {
                array_shift($matches);
                return call_user_func_array($route['callback'], $matches);
            }
        }

        http_response_code(200);
        echo json_encode(["message" => "200 - Página não encontrada"]);
    }
}
