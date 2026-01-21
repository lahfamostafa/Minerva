<?php

class WorkService{
    private workModel $workModel;

    public function __construct()
    {
        $this->workModel = new workModel();
    }
    public function createWork(array $data){
        if(
            empty($_POST['title']) ||
            empty($_POST['description']) ||
            empty($_POST['due_date']) ||
            empty($_POST['class_id'])
            ){
                die("Tous les champs sont obligatoires");
            } 

           return $this->workModel->create($data);
    }
    public function getWorkByClassId(int $classId){
        $this->workModel->getByClass($classId);
    }
    public function getWork(int $id){
        return $this->workModel->findById($id);
    }
    public function updateWork(int $id, array $data){
        if(
            empty($_POST['title']) ||
            empty($_POST['description']) ||
            empty($_POST['due_date']) ||
            empty($_POST['class_id'])
            ){
                die("Tous les champs sont obligatoires");
            } 
            return $this->workModel->update($id, $data);
    }
    public function deletWork($id){
        return $this->workModel->delete($id);
    }
}