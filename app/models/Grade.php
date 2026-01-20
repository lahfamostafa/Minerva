<?php

class grade
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function createGrade(int $studentId, int $courseId, float $gradeValue)
    {
        $sql = 'INSERT INTO grades (student_id,course_id,grade_value) VALUES(?,?,?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$studentId, $courseId, $gradeValue]);
    }
    public function getGradesByStudentId(int $studentId)
    {
        $sql = 'SELECT * FROM grades WHERE student_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateGrade(int $id, float $gradeValue)
    {
        $sql = 'UPDATE grades SET grade_value=? WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$gradeValue, $id]);
    }
    public function deleteGrade(int $id)
    {
        $sql = 'DELETE FROM grades WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function getAllGrades()
    {
        $sql = 'SELECT * FROM grades';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradesByCourseId(int $courseId)
    {
        $sql = 'SELECT * FROM grades WHERE course_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradeById(int $id)
    {
        $sql = 'SELECT * FROM grades WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getGradesByStudentAndCourse(int $studentId, int $courseId)
    {
        $sql = 'SELECT * FROM grades WHERE student_id=? AND course_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId, $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAverageGradeByStudent(int $studentId)
    {
        $sql = 'SELECT AVG(grade_value) as average_grade FROM grades WHERE student_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAverageGradeByCourse(int $courseId)
    {
        $sql = 'SELECT AVG(grade_value) as average_grade FROM grades WHERE course_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getTopGradesByCourse(int $courseId, int $limit)
    {
        $sql = 'SELECT * FROM grades WHERE course_id=? ORDER BY grade_value DESC LIMIT ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLowestGradesByCourse(int $courseId, int $limit)
    {
        $sql = 'SELECT * FROM grades WHERE course_id=? ORDER BY grade_value ASC LIMIT ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradeCountByStudent(int $studentId)
    {
        $sql = 'SELECT COUNT(*) as grade_count FROM grades WHERE student_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['grade_count'];
    }
    public function getGradeCountByCourse(int $courseId)
    {
        $sql = 'SELECT COUNT(*) as grade_count FROM grades WHERE course_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['grade_count'];
    }
    public function getOverallAverageGrade()
    {
        $sql = 'SELECT AVG(grade_value) as overall_average FROM grades';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getGradesAboveThreshold(float $threshold)
    {
        $sql = 'SELECT * FROM grades WHERE grade_value > ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradesBelowThreshold(float $threshold)
    {
        $sql = 'SELECT * FROM grades WHERE grade_value < ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMedianGradeByCourse(int $courseId)
    {
        $sql = 'SELECT grade_value FROM grades WHERE course_id=? ORDER BY grade_value';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        $grades = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $count = count($grades);
        if ($count === 0) {
            return null;
        }
        $middle = (int)($count / 2);
        if ($count % 2) {
            return $grades[$middle];
        } else {
            return ($grades[$middle - 1] + $grades[$middle]) / 2;
        }
    }
    public function getGradeDistributionByCourse(int $courseId)
    {
        $sql = 'SELECT grade_value, COUNT(*) as count FROM grades WHERE course_id=? GROUP BY grade_value';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentsWithGradesAbove(float $threshold)
    {
        $sql = 'SELECT DISTINCT student_id FROM grades WHERE grade_value > ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentsWithGradesBelow(float $threshold)
    {
        $sql = 'SELECT DISTINCT student_id FROM grades WHERE grade_value < ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCoursesWithAverageGradeAbove(float $threshold)
    {
        $sql = 'SELECT course_id, AVG(grade_value) as average_grade FROM grades GROUP BY course_id HAVING average_grade > ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCoursesWithAverageGradeBelow(float $threshold)
    {
        $sql = 'SELECT course_id, AVG(grade_value) as average_grade FROM grades GROUP BY course_id HAVING average_grade < ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$threshold]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradeStatisticsByCourse(int $courseId)
    {
        $sql = 'SELECT 
                    AVG(grade_value) as average_grade,
                    MIN(grade_value) as min_grade,
                    MAX(grade_value) as max_grade,
                    COUNT(*) as grade_count
                FROM grades WHERE course_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getGradeStatisticsByStudent(int $studentId)
    {
        $sql = 'SELECT 
                    AVG(grade_value) as average_grade,
                    MIN(grade_value) as min_grade,
                    MAX(grade_value) as max_grade,
                    COUNT(*) as grade_count
                FROM grades WHERE student_id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }   
    public function getGradesByDateRange(string $startDate, string $endDate)
    {
        $sql = 'SELECT * FROM grades WHERE created_at BETWEEN ? AND ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradesByStudentAndDateRange(int $studentId, string $startDate, string $endDate)
    {
        $sql = 'SELECT * FROM grades WHERE student_id=? AND created_at BETWEEN ? AND ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId, $startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradesByCourseAndDateRange(int $courseId, string $startDate, string $endDate)
    {
        $sql = 'SELECT * FROM grades WHERE course_id=? AND created_at BETWEEN ? AND ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId, $startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTopStudentsByAverageGrade(int $limit)
    {
        $sql = 'SELECT student_id, AVG(grade_value) as average_grade 
                FROM grades 
                GROUP BY student_id 
                ORDER BY average_grade DESC 
                LIMIT ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBottomStudentsByAverageGrade(int $limit)
    {
        $sql = 'SELECT student_id, AVG(grade_value) as average_grade 
                FROM grades 
                GROUP BY student_id 
                ORDER BY average_grade ASC 
                LIMIT ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCoursesTaughtByTeacher(int $teacherId)
    {
        $sql = 'SELECT DISTINCT c.id, c.name 
                FROM courses c 
                JOIN classes cl ON c.class_id = cl.id 
                WHERE cl.teacher_id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGradesByTeacherAndCourse(int $teacherId, int $courseId)
    {
        $sql = 'SELECT g.* 
                FROM grades g 
                JOIN courses c ON g.course_id = c.id 
                JOIN classes cl ON c.class_id = cl.id 
                WHERE cl.teacher_id = ? AND c.id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$teacherId, $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
