<?php

class gradeController{
    private gradeService $gradeService;
    public function __construct()
    {
       $this->gradeService = new gradeService();
    }

    public function store(){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        $role ='teacher';
        if($_SESSION['user']['role'] !== $role){
            die("you don't have the permission the this page");
        }
        try {
            $submissionId = $_POST['submission_id'];
            $grade = $_POST['grade'];
            $comment = $_POST['comment'] ?? '';
            $this->gradeService->gradeSubmission($submissionId,$grade,$comment);
            header("Location: /teacher/dashboard");
            exit;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function myGrade(){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        $grades = $this->gradeService->getGradesByStudent($_SESSION['user_id']);
        require '../app/views/grade/my.php';
    }
}