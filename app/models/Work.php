<?php
namespace App\models;
use App\core\Database;
use PDO;

 class work{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create(array $data){
        $sql = "INSERT INTO work(title,description,file_path,class_id,teacher_id,deadline) VALUES(?,?,?,?,?,?)";
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['file_path'],
            $data['class_id'],
            $data['teacher_id'],
            $data['deadline']
        ]);
    }
    public function findById(int $id){
        $sql ="SELECT * FROM works WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getByClass(int $classId){
        $sql="SELECT * FROM works WHERE class_id=?";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update(int $id, array $data){
        $sql = "UPDATE works SET title = ?, description = ?, due_date = ? WHERE id = ?";
        $stmt= $this->pdo->prepare($sql);
       return  $stmt->execute([
            $data['title'],
            $data['description'],
            $data['due_date']
        ]);
    }
    public function delete(int $id){
        $sql ="DELETE FROM works WHERE id =?";
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
 }