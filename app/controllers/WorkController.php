<?php

class WorkController{

    private WorkService $workService;

    public function __construct()
    {
        $this->workService = new WorkService();
    }

    public function store(){
        if(!isset($_SESSION['user_id'])){
            header("Location : /login");
            exit;
        }
         $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'due_date' => $_POST['due_date'],
                'teacher_id' => $_SESSION['user_id'],
                'class_id' => $_SESSION['class_id']
            ];
            $this->workService->createWork($data);
            header("location: /teacher/dashbord");
            exit;
    }

    public function index($classId){
        if(!isset($_SESSION['user_id'])){
            header("location: /login");
            exit;
        }
        $works = $this->workService->getWorkByClassId($classId);
            require '../../app/work/index.php';
        }

        public function show($id){
            if(!isset($_SESSION['user_id'])){
                header("Location: /login");
                exit;
            }
            $work = $this->workService->getWork($id);

            if(!$work){
                die("work not found");
            }
            require '../../app/views/work/show.php';
        }
        public function update($id){
            if(!isset($_SESSION['user_id'])){
                header("Location: /login");
                exit;
            }
            if(
                empty($_POST['title']) ||
                empty($_POST['description']) ||
                empty($_POST['due_date'])
            ){
                die("tous les champs sont obligatoires");
            }
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'due_date' => $_POST['due_date']
            ];
            $this->workService->updateWork($id,$data);

            header("Location: /teacher/dashboard");
            exit;
        }
        public function delete($id){
            if(!isset($_SESSION['user_id'])){
                header("Location: /login");
            }
            $this->workService->deletWork($id);
            header("Location: /teacher/dashboard"); 
            exit;
        }


}



