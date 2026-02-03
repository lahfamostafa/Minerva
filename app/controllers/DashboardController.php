<?php

use App\services\AuthService;
use App\services\ClasseService;
use App\services\WorkService;
    class DashboardController extends App\core\BaseController{

        private AuthService $auth;
        private ClasseService $class;
        private WorkService $work;

        public function __construct(){
            $this->auth = new AuthService();
            $this->class = new ClasseService();
            $this->work = new WorkService();
        }

        public function student(){
            $user = $this->auth->currentUser();
            if (!$user || strtolower($user['role']) !== "student") {
                header("Location: " . BASE_URL . "/login");
                exit;
            }
            $classUser = $this->class->getStudentClass($_SESSION['user_id']);
            $user1= $classUser['id'];
            $works = $this->work->getWorkByClassId($user1);

            $this->render('student' , 'dashboard' , compact('user','works'));
        }

        public function teacher(){
            $user = $this->auth->currentUser();
            if (!$user || strtolower($user['role']) !== "teacher") {
                header("Location: ". BASE_URL ."/login");
                exit;
            }

            $this->render('teacher' , 'dashboard' , compact('user'));
        }

        public function home(){
            $user = $this->auth->currentUser();

            if(!$user) {header("Location: " . BASE_URL . "/login");exit;}

            if(strtolower($user['role']) === 'teacher') {header("Location: ". BASE_URL ."/dashboard/teacher");exit;}
            header("Location: ". BASE_URL ."/dashboard/student");
            exit;
        }
    }
?>