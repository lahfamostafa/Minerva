<?php

use App\services\ClasseService;

class ClassController
{

    public ClasseService $classeService;

    public function __construct()
    {
        $this->classeService = new ClasseService();
    }

    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $role = 'teacher';
        if ($_SESSION['user']['role'] !== $role) {
            die("you don't have the permission");
        }
        try {
            $nom = $_POST['nom'];
            $teacherId = $_SESSION['user_id'];
            $this->classeService->createClass($nom, $teacherId);

            header("Location: /teacher/dashboard");
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function assignStudent(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $role = 'teacher';
        if ($_SESSION['user']['role'] !== $role) {
            die("you don't have the permission");
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
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $role = 'teacher';
        if ($_SESSION['user']['role'] !== $role) {
            die("you don't have the permission");
        }
        $classes = $this->classeService->getTeacherClasses($_SESSION['user_id']);

        require '../app/views/class/teacher_classes.php';
    }
    public function myClasses(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $class = $this->classeService->getStudentClass($_SESSION['user_id']);

        require '../app/views/class/student_class.php';
    }
}
