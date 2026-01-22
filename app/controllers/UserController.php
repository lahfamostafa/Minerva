<?php
use app\core\BaseController;
use App\models\User;
use App\services\AuthService;
    class UserController extends BaseController {
        public $UserModel ; 
        public $authService;
        
        public function __construct(){
            $this->UserModel = new User();
            $this->authService = new AuthService();
        }

        public function storeTeacher(){
            $result = $this->authService->register($_POST['nom'] , $_POST['email'] ,$_POST['password'],'teacher');
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render('teacher','register',compact('error'));
                return;
            }

            header('Location: '.BASE_URL.'teacher/index');    
            exit;        
        }

        public function storeStudent(){
            $result = $this->authService->register($_POST['nom'] , $_POST['email'] ,$_POST['password'],'student');
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render('student','register',compact('error'));
                return;
            }

            header('Location: '.BASE_URL.'student/index');    
            exit;        
        }
    }
?>