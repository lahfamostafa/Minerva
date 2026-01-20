<?php

class Teacher
{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function createTeacher(int $user_id, int $speciality)
    {
        $sql = 'INSERT INTO teachers(user_id,speciality) VALUES(?,?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $speciality]);
    }
    public function findByUserId(int $id)
    {
        $sql = 'SELECT * FROM teachers WHERE user_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateSpeciality(int $id, string $speciality)
    {
        $sql = 'UPDATE teachers SET speciality =? WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$speciality, $id]);
    }
    public function delete(int $id)
    {
        $sql = 'DELETE FROM teachers WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getAllTeachers()
    {
        $sql = 'SELECT * FROM teachers';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findBySpeciality(string $speciality)
    {
        $sql = 'SELECT * FROM teachers WHERE speciality = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$speciality]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById(int $id)
    {
        $sql = 'SELECT * FROM teachers WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByName(string $name)
    {
        $sql = 'SELECT t.* FROM teachers t JOIN users u ON t.user_id = u.id WHERE u.name = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
