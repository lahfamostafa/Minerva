<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Router.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


session_start();

$router = new Router();

//auth
$router->get('/login',  ['AuthController', 'showLogin']);
$router->post('/login', ['AuthController', 'login']);
$router->get('/register',  ['AuthController', 'showRegister']);
$router->post('/register', ['AuthController', 'registerTeacher']);
$router->get('/logout', ['AuthController', 'logout']);

//dashboard
$router->get('/dashboard/student', ['DashboardController', 'student']);
$router->get('/dashboard/teacher', ['DashboardController', 'teacher']);

//teacher->createStudent
$router->get('/teacher/students/create', ['UserController', 'createStudentForm']);
$router->post('/teacher/students',       ['UserController', 'createStudent']);

//home
$router->get('/', ['DashboardController', 'home']);

//classe
$router->get('/teacher/classes/create', ['ClassController', 'createClasseForm']);
$router->post('/teacher/classes', ['ClassController', 'store']);
$router->get('/teacher/classes/{id}', ['ClassController', 'ClasseStudents']);

//student
$router->post('/teacher/classes/remove', ['StudentController', 'removeStudent']);
$router->post('/teacher/classes/updateF', ['StudentController', 'updateForm']);
$router->post('/teacher/students/update', ['StudentController', 'update']);


$router->dispatch($_SERVER['REQUEST_URI']);
?>