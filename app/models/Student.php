<?php
namespace App\models;
use App\core\Database;

use PDO;
use PDOException;

    class Student{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    public function updateStudent(int $userId , string $name){
        $sql='update users set name = ? WHERE id = ?';
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$name,$userId]);
    }
    public function findByClassId(int $classId){
        $sql='SELECT * FROM students WHERE class_id=?';
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    }
?>