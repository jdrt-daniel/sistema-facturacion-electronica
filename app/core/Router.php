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
