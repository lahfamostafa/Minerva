<?php
use App\core\Database;

use PDO;
use PDOException;

    class Student{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function createStudent(int $userId,int $classId){
        $sql='INSERT INTO students (user_id,class_id) VALUES(?,?)';
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$userId,$classId]);
    }
    public function findUserById(int $userId){
        $sql='SELECT * FROM students WHERE user_id = ?';
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByClassId(int $classId){
        $sql='SELECT * FROM students WHERE class_id=?';
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete(int $id){
        $sql='DELETE FROM students WHERE id=?';
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    }