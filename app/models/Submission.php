<?php
use App\core\Database;
use PDO;
use PDOException;

class SubmissionModel
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function createSubmission(int $studentId, int $workId, string $content)
    {
        $sql = 'INSERT INTO submissions (student_id,work_id,content) VALUES(?,?,?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$studentId, $workId, $content]);
    }
    public function findByStudentAndWork(int $studentId, int $workId)
    {
        $sql = 'SELECT * FROM submissions WHERE student_id = ? AND work_id= ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId, $workId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getSubmissionsByWork(int $workId)
    {
        $sql = 'SELECT * FROM submissions WHERE work_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$workId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateSubmission(int $id, string $content)
    {
        $sql = 'UPDATE submissions SET content = ? WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$content, $id]);
    }
    public function deleteSubmission(int $id)
    {
        $sql = 'DELETE FROM submissions WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function getAllSubmissions()
    {
        $sql = 'SELECT * FROM submissions';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSubmissionsByStudent(int $studentId)
    {
        $sql = 'SELECT * FROM submissions WHERE student_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}