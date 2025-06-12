<?php

class Router
{
    protected $routes = [];
    protected $params = [];

    public function get($route, $controller)
    {
        $this->addRoute('GET', $route, $controller);
    }

    public function post($route, $controller)
    {
        $this->addRoute('POST', $route, $controller);
    }

    protected function addRoute($method, $route, $controller)
    {
        $this->routes[$method][$route] = $controller;
    }

    public function dispatch()
    {
        $url = $this->getUrl();
        $method = $_SERVER['REQUEST_METHOD'];

        // Rutas que no requieren autenticación
        $publicRoutes = [
            '/login',
            '/login/validar'
        ];

        // Verificar si la sesión está iniciada
        // Es crucial que session_start() se llame al inicio de tu aplicación (ej. en index.php)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si la ruta no es pública y el usuario no está logueado, redirigir al login
        if (!in_array($url, $publicRoutes) && !isset($_SESSION['usuario'])) {
            header('Location: /login');
            exit;
        }

        if (isset($this->routes[$method][$url])) {
            $controller = $this->routes[$method][$url];
            $this->executeController($controller);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
        }
    }

    protected function getUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        return $url;
    }

    protected function executeController($controller)
    {
        list($controllerName, $action) = explode('@', $controller);
        $controllerFile = BASE_PATH . "/app/controllers/{$controllerName}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controllerName();
            $controllerInstance->$action();
        } else {
            throw new Exception("Controller not found");
        }
    }
}
