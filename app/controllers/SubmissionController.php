<?php

class SubmissionController
{
    private SubmissionService $submissionService;

    public function __construct()
    {
        $this->submissionService = new SubmissionService();
    }

    public function store(){
        if(!isset($_SESSION['user_id'])){
            header("location: /login");
            exit;
        }
        try{
            $studentId = $_SESSION['user_id'];
            $workId = $_POST['work_id'];
            $content = $_POST['content'];

            $this->submissionService->submit($studentId, $workId, $content);

            header("Location: /student/dasboard");
            exit;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function mySubmissions(){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        $submissions = $this->submissionService->getMySubmission($_SESSION['user_id']);
        require '../app/views/submission/my.php';
    }
    public function index($workId){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        require '../app/views/submission/index.php';
    }
}
