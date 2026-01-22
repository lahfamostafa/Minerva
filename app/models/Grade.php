<?php

use App\core\Database;
use PDO;

class gradeModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function create(int $submissionId, int $grade, string $comment){
        $sql ="INSERT INTO grades(submission_id, grade, comment) VALUES(?,?,?)";
        $stmt= $this->pdo->prepare($sql);
       return $stmt->execute([$submissionId, $grade, $comment]);
    }
    public function getByStudent(int $studentId){
        $sql ="SELECT g.*, w*title FROM grades g JOIN submissions s ON g.submission_id = s.id JOIN works w ON s.work_id = w.id
    WHERE s.student_id = ?";
    $stmt= $this->pdo->prepare($sql);
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findBySubmission(int $submissionId){
        $sql ="SELECT * FROM grades WHERE submission_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$submissionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
