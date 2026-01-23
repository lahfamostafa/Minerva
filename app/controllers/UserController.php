<?php

use App\services\AuthService;



    class UserController extends App\core\BaseController {
        public $authService;
        
        public function __construct(){
            $this->authService = new AuthService();
        }

        public function createStudent(){
            try{
                $nom = $_POST['nom'];
                $email = $_POST['email'];
    
                if($nom === '' || $email === '')
                    throw new Exception("Tous les champs sont obligatoires");
                $this->authService->storeStudent($nom,$email);
    
                header("Location: " . BASE_URL . "/dashboard/teacher");
                exit;
            }catch(Exception $e){
                $this->render('teacher','add_student',['error' => $e->getMessage()]);
            }
        }

        public function createStudentForm(){
            $this->render('teacher','add_student',['error' => null]);
        }
        
    }
?>