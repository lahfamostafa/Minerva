<?php
    class UserController extends BaseController {
        private $UserService ; 
        private $authService;

        public function __construct(){
            $this->UserModel = new User();
            $this->authService = new AuthService();
        }

        public function storeUser(){
            $result = $authService->register($_POST);
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render($file,'register',compact('error'));
                return;
            }
            if($_POST['role'] == "teacher")
                header('Location: '.BASE_URL.'teacher/index');
            else if($_POST['role'] == "student")
                header('Location: '.BASE_URL.'student/index');
            else echo "hadchi makayeeench";
                
        }


        public function storeTeacher(){
            $result = $authService->register($_POST,'teacher');
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render($file,'register',compact('error'));
                return;
            }

            header('Location: '.BASE_URL.'teacher/index');    
            exit;        
        }

        public function storeStudent(){
            $result = $authService->register($_POST,'student');
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render($file,'register',compact('error'));
                return;
            }

            header('Location: '.BASE_URL.'student/index');    
            exit;        
        }
    }
?>