<?php

use App\services\AuthService;

    class DashboardController extends App\core\BaseController{

        private AuthService $auth;

        public function __construct(){
            $this->auth = new AuthService();
        }

        public function student(){
            $user = $this->auth->currentUser();
            if (!$user || strtolower($user['role']) !== "student") {
                header("Location: " . BASE_URL . "/login");
                exit;
            }

            $this->render('student' , 'dashboard' , compact('user'));
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

            if(!$user) {header("Location: " . BASE_URL . "/login");;exit;}

            if(strtolower($user['role']) === 'teacher') {header("Location: ". BASE_URL ."/dashboard/teacher");exit;}
            header("Location: ". BASE_URL ."/dashboard/student");
            exit;
        }
    }
?>