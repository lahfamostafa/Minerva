<?php

require_once __DIR__ . "/../config/config.php";
    class Router{
        public $routes = [];

        function get($path , $action){
            $this->routes['GET'][$path] = $action;
        }
        function post($path , $action){
            $this->routes['POST'][$path] = $action;
        }

        public function dispatch($uri){
            $path = parse_url($uri, PHP_URL_PATH);

            $baseDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
            if($baseDir !== '' && strpos($path , $baseDir) === 0){
                $path = substr($path , strlen($baseDir));
            }
            $path = '/' . ltrim($path ,'/');
            $path = rtrim($path , '/');
            if($path === '') $path = '/';

            $method = $_SERVER['REQUEST_METHOD'];
            $action = $this->routes[$method][$path] ?? null;

            if(!$action){
                http_response_code(404);
                echo "404 Not found<br>";
                echo 'methode : ' . $method . '<br>path : ' . $path . '<br>action : ' . $action;
                return;
            }

            $controllerName = $action[0];
            $methodeName = $action[1];

            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

            if(!file_exists($controllerFile)){
                http_response_code(500);
                echo "Controller $controllerName introuvable";
                return;
            }

            require_once $controllerFile;

            if(!class_exists($controllerName)){
                http_response_code(500);
                echo "Classe $controllerName introuvable";
                return;
            }

            $controller = new $controllerName();

            if(!method_exists($controller , $methodeName)){
                http_response_code(500);
                echo "Méthode $methodeName introuvable dans $controllerName";
                return;
            }

            $controller->$methodeName();
        }
    }

?>