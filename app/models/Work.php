<?php

class work
{
    private PDO $PDO;
    public function __construct()
    {
        $this->PDO = Database::getInstance()->getConnection();
    }

    public function createWork(array $data)
    {
        $sql = 'INSERT INTO works (title,description,due_date,teacher_id) VALUES(?,?,?,?)';
        $stmt = $this->PDO->prepare($sql);
        return $stmt->execute([$data['title'], $data['description'], $data['due_date'], $data['teacher_id']]);
    }

    public function getAllWorks()
    {
        $sql = 'SELECT * FROM works';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById(int $id)
    {
        $sql = 'SELECT * FROM works WHERE id = ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateWork(int $id, array $data)
    {
        $sql = 'UPDATE works SET title=?, description=?, due_date=? WHERE id=?';
        $stmt = $this->PDO->prepare($sql);
        return $stmt->execute([$data['title'], $data['description'], $data['due_date'], $id]);
    }
    public function deleteWork(int $id)
    {
        $sql = 'DELETE FROM works WHERE id=?';
        $stmt = $this->PDO->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function findByTitle(string $title)
    {
        $sql = 'SELECT * FROM works WHERE title=?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$title]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function searchWorks(string $keyword)
    {
        $sql = 'SELECT * FROM works WHERE title LIKE ? OR description LIKE ?';
        $stmt = $this->PDO->prepare($sql);
        $likeKeyword = "%$keyword%";
        $stmt->execute([$likeKeyword, $likeKeyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countWorks()
    {
        $sql = 'SELECT COUNT(*) as total FROM works';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getWorksByTeacher(int $teacherId)
    {
        $sql = 'SELECT * FROM works WHERE teacher_id = ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksDueBeforeDate(string $date)
    {
        $sql = 'SELECT * FROM works WHERE due_date < ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksDueAfterDate(string $date)
    {
        $sql = 'SELECT * FROM works WHERE due_date > ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksByDateRange(string $startDate, string $endDate)
    {
        $sql = 'SELECT * FROM works WHERE due_date BETWEEN ? AND ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRecentWorks(int $limit)
    {
        $sql = 'SELECT * FROM works ORDER BY due_date DESC LIMIT ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUpcomingWorks(int $limit)
    {
        $sql = 'SELECT * FROM works WHERE due_date >= CURDATE() ORDER BY due_date ASC LIMIT ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOverdueWorks()
    {
        $sql = 'SELECT * FROM works WHERE due_date < CURDATE()';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksByTeacherAndDateRange(int $teacherId, string $startDate, string $endDate)
    {
        $sql = 'SELECT * FROM works WHERE teacher_id = ? AND due_date BETWEEN ? AND ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$teacherId, $startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countWorksByTeacher(int $teacherId)
    {
        $sql = 'SELECT COUNT(*) as total FROM works WHERE teacher_id = ?';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$teacherId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getLatestWorkByTeacher(int $teacherId)
    {
        $sql = 'SELECT * FROM works WHERE teacher_id = ? ORDER BY due_date DESC LIMIT 1';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$teacherId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getEarliestWorkByTeacher(int $teacherId)
    {
        $sql = 'SELECT * FROM works WHERE teacher_id = ? ORDER BY due_date ASC LIMIT 1';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$teacherId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getWorksByTitleKeyword(string $keyword)
    {
        $sql = 'SELECT * FROM works WHERE title LIKE ?';
        $stmt = $this->PDO->prepare($sql);
        $likeKeyword = "%$keyword%";
        $stmt->execute([$likeKeyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksByDescriptionKeyword(string $keyword)
    {
        $sql = 'SELECT * FROM works WHERE description LIKE ?';
        $stmt = $this->PDO->prepare($sql);
        $likeKeyword = "%$keyword%";
        $stmt->execute([$likeKeyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksByTeacherAndTitleKeyword(int $teacherId, string $keyword)
    {
        $sql = 'SELECT * FROM works WHERE teacher_id = ? AND title LIKE ?';
        $stmt = $this->PDO->prepare($sql);
        $likeKeyword = "%$keyword%";
        $stmt->execute([$teacherId, $likeKeyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksByTeacherAndDescriptionKeyword(int $teacherId, string $keyword)
    {
        $sql = 'SELECT * FROM works WHERE teacher_id = ? AND description LIKE ?';
        $stmt = $this->PDO->prepare($sql);
        $likeKeyword = "%$keyword%";
        $stmt->execute([$teacherId, $likeKeyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksDueToday()
    {
        $sql = 'SELECT * FROM works WHERE due_date = CURDATE()';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksDueThisWeek()
    {
        $sql = 'SELECT * FROM works WHERE YEARWEEK(due_date, 1) = YEARWEEK(CURDATE(), 1)';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksDueThisMonth()
    {
        $sql = 'SELECT * FROM works WHERE MONTH(due_date) = MONTH(CURDATE()) AND YEAR(due_date) = YEAR(CURDATE())';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorksDueThisYear()
    {
        $sql = 'SELECT * FROM works WHERE YEAR(due_date) = YEAR(CURDATE())';
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
