<?php
    class attendance{
        private PDO $pdo;
        public function __construct()
        {
            $this->pdo = Database::getInstance()->getConnection();
        }
        public function markAttendance(int $studentId, string $date, string $status){
            $sql = "INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$studentId, $date, $status]);
        }
        public function getAttendanceByStudentId(int $studentId){
            $sql = "SELECT * FROM attendance WHERE student_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$studentId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function updateAttendance(int $id, string $status){
            $sql = "UPDATE attendance SET status = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$status, $id]);
        }
        public function deleteAttendance(int $id){
            $sql = "DELETE FROM attendance WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        }
        public function getAllAttendance(){
            $sql = "SELECT * FROM attendance";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getAttendanceByDate(string $date){
            $sql = "SELECT * FROM attendance WHERE date = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getAttendanceByStatus(string $status){
            $sql = "SELECT * FROM attendance WHERE status = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getAttendanceByStudentAndDate(int $studentId, string $date){
            $sql = "SELECT * FROM attendance WHERE student_id = ? AND date = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$studentId, $date]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getAttendanceByStudentAndStatus(int $studentId, string $status){
            $sql = "SELECT * FROM attendance WHERE student_id = ? AND status = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$studentId, $status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getAttendanceByDateAndStatus(string $date, string $status){
            $sql = "SELECT * FROM attendance WHERE date = ? AND status = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$date, $status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }



?>