<?php

use App\services\AuthService;
use App\services\AttendanceService;

    class UserController extends App\core\BaseController {
        public $authService;
        public AttendanceService $attService;
        
        public function __construct(){
            $this->authService = new AuthService();
            $this->attService = new AttendanceService();
        }

        //post
        public function createStudent(){
            try{
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $classId = $_POST['class_id'];
    
                if($nom === '' || $email === '' || $classId === '')
                    throw new Exception("Tous les champs sont obligatoires");
                $studentId = $this->authService->storeStudent($nom , $email , $classId);
                $this->attService->markAttendance((int)$classId , (int)$studentId);
    
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