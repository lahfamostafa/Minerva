<?php

class Submission
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function createSubmission(int $studentId, int $assignmentId, string $content)
    {
        $sql = 'INSERT INTO submissions (student_id,assignment_id,content) VALUES(?,?,?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$studentId, $assignmentId, $content]);
    }
    public function findByStudentAndAssignment(int $studentId, int $assignmentId)
    {
        $sql = 'SELECT * FROM submissions WHERE student_id = ? AND assignment_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId, $assignmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getSubmissionsByAssignment(int $assignmentId)
    {
        $sql = 'SELECT * FROM submissions WHERE assignment_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$assignmentId]);
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
    public function getSubmissionsByContentKeyword(string $keyword)
    {
        $sql = 'SELECT * FROM submissions WHERE content LIKE ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countSubmissions()
    {
        $sql = 'SELECT COUNT(*) as total FROM submissions';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getSubmissionsByDateRange(string $startDate, string $endDate)
    {
        $sql = 'SELECT * FROM submissions WHERE created_at BETWEEN ? AND ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function gradeSubmission(int $id, float $grade)
    {
        $sql = 'UPDATE submissions SET grade = ? WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$grade, $id]);
    }
    public function getGradedSubmissions()
    {
        $sql = 'SELECT * FROM submissions WHERE grade IS NOT NULL';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUngradedSubmissions()
    {
        $sql = 'SELECT * FROM submissions WHERE grade IS NULL';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAverageGrade()
    {
        $sql = 'SELECT AVG(grade) as average_grade FROM submissions WHERE grade IS NOT NULL';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average_grade'];
    }
    public function getSubmissionsByStudentAndGradeRange(int $studentId, float $minGrade, float $maxGrade)
    {
        $sql = 'SELECT * FROM submissions WHERE student_id = ? AND grade BETWEEN ? AND ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId, $minGrade, $maxGrade]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTopSubmissions(int $limit)
    {
        $sql = 'SELECT * FROM submissions WHERE grade IS NOT NULL ORDER BY grade DESC LIMIT ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBottomSubmissions(int $limit)
    {
        $sql = 'SELECT * FROM submissions WHERE grade IS NOT NULL ORDER BY grade ASC LIMIT ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSubmissionCountByStudent(int $studentId)
    {
        $sql = 'SELECT COUNT(*) as submission_count FROM submissions WHERE student_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['submission_count'];
    }
    public function getSubmissionsWithGrades()
    {
        $sql = 'SELECT * FROM submissions WHERE grade IS NOT NULL';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
