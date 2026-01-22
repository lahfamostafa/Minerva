<?php

    require_once __DIR__ . '/../app/core/Router.php';

    $router = new Router();

    $router->get('/', ['StudentController', 'index']);
    $router->get('/students', ['StudentController', 'students']);
    $router->get('/student/add', ['StudentController', 'addStudentForm']);
    $router->get('/register', ['StudentController', 'register']);
    $router->get('/login', ['StudentController', 'login']);
    $router->post('/students', ['StudentController', 'storeStudent']);
    $router->post('/login', ['StudentController', 'postLogin']);
    // $router->post('/register', ['StudentController', 'authenticate']);

    $router->dispatch($_SERVER['REQUEST_URI']);
?>