<?php

    class Teacher{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function createTeacher(int $user_id,int $speciality){
        $sql='INSERT INTO teachers(user_id,speciality) VALUES(?,?)';
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$user_id,$speciality]);
        
    }
    public function findByUserId(int $id){
        $sql='SELECT * FROM teachers WHERE user_id=?';
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateSpeciality(int $id,string $speciality){
        $sql='UPDATE teachers SET speciality =? WHERE id=?';
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$speciality,$id]);
    }


    }



?>