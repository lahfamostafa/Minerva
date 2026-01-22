<?php

use App\services\AuthService;
    class DashboardController{

        public function student(){
            $AuthService = new AuthService();
            $user = $AuthService->currentUser();
            if (!$user && $user['role'] !== "studet") {
                header('Location: /login');
                exit;
            }

            require_once __DIR__ . "/../views/student/dashboard.php";
        }

        public function teacher(){
            $AuthService = new AuthService();
            $user = $AuthService->currentUser();
            if (!$user && $user['role'] !== "teacher") {
                header('Location: /login');
                exit;
            }

            require_once __DIR__ . "/../views/teacher/dashboard.php";
        }

        public function home(){
            $AuthService = new AuthService();
            $user = $AuthService->currentUser();

            if(!$user) {header('Location: /login');exit;}

            if($user['role'] === 'teacher') {header('Location: /Dashboard/teacher');exit;}
            header('Location: /Dashboard/student');
            exit;
        }
    }
?>