<?php

class Router
{
    private $routes = [];

    public function add($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remover el prefijo del directorio si existe
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/') {
            $path = substr($path, strlen($scriptName));
        }
        
        $path = $path ?: '/';

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $path)) {
                return $this->callHandler($route['handler']);
            }
        }

        http_response_code(404);
        echo "404 - Página no encontrada";
    }

    private function matchPath($routePath, $requestPath)
    {
        return $routePath === $requestPath;
    }

    private function callHandler($handler)
    {
        list($controller, $method) = explode('@', $handler);
        
        require_once __DIR__ . '/Controllers/' . $controller . '.php';
        
        $controllerInstance = new $controller();
        return $controllerInstance->$method();
    }
}
