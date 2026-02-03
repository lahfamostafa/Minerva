<?php
namespace App\services;
use App\Models\Work;
class WorkService{
    private work $work;

    public function __construct()
    {
        $this->work = new work();
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

           return $this->work->create($data);
    }
    public function getWorkByClassId(int $classId){
        return $this->work->getByClass($classId);
    }
    public function getWork(int $id){
        return $this->work->findById($id);
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
            return $this->work->update($id, $data);
    }
    public function deletWork($id){
        return $this->work->delete($id);
    }
}