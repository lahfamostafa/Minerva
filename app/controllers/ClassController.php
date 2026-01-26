<?php

use App\services\ClasseService;

class ClassController extends App\core\BaseController{

    public ClasseService $classeService;

    public function __construct(){
        $this->classeService = new ClasseService();
    }

    //get
    public function createClasseForm(){
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
            http_response_code(403);
            die("Vous n'avez pas la permission");
        }

        $this->render('teacher','add_classe',['error' => null]);
    }

    //post
    public function store(){
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
            http_response_code(403);
            die("Vous n'avez pas la permission");
        }
        try {
            $nom = $_POST['name'];
            $teacherId = (int) $_SESSION['user_id'];
            $this->classeService->createClass($nom, $teacherId);

            header("Location: " . BASE_URL . "/dashboard/teacher");
            exit;
        } catch (Exception $e) {
            $this->render('teacher','add_classe',['error' => $e->getMessage()]) ;
        }
    }
    public function assignStudent(){
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
            die("Vous n'avez pas la permission");
        }
        try{
            $studentId = $_POST['student_id'];
            $classId = $_POST['class_id'];
            $this->classeService->assignstudent($studentId, $classId);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function myClass(){
        $teacherId = (int)($_SESSION['user_id'] ?? 0);
        if ($teacherId === 0) die("Ensegnant introuvable");
        
        return $this->classeService->getTeacherClasses($teacherId);
    }

    public function ClasseStudents($id){
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
            http_response_code(403);
            die("Vous n'avez pas la permission");
        }
        $classId = (int)$id;
        $class = $this->classeService->findClassById($classId);
        $students = $this->classeService->getClassStudents($classId);
        $this->render('teacher','classe',['class'=>$class , 'students'=>$students,'error'=>null]);
    }

    public function myClasses(){
        $teacherId = (int)($_SESSION['user_id'] ?? 0);
        if ($teacherId === 0) die("Ensegnant introuvable");

        return $this->classeService->getTeacherClass($teacherId);
    }
}
