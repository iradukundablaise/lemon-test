<?php

namespace App\Base;

use App\Base\Request;

class Router {

    private array $routes = [];
    public function __construct(){}

    public function get(string $path, array $handler): Router{
        return $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, array $handler): Router{
        return $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, array $handler): Router{
        return $this->addRoute('PUT', $path, $handler);
    }

    public function patch(string $path, array $handler): Router{
        return $this->addRoute('PATCH', $path, $handler);
    }

    public function delete(string $path, array $handler): Router{
        return $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute(string $method, string $path, array $handler): Router{
        $this->routes[strtoupper($method)][$path] = $handler;
        return $this;
    }


    public function dispatch(string $method, string $path){
        $path = parse_url($path, PHP_URL_PATH);
        $handler = $this->routes[strtoupper($method)][$path] ?? null;

        $response = "<h1>404 Not Found</h1>";

        if($handler){
            [$class, $action] = $handler;
            $response = call_user_func([new $class, $action]);
        }else{
            http_response_code(404);
        }
        echo $response;
    }
}