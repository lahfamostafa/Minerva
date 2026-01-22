<?php
namespace App\Models;
use App\core\Database;
USE PDO;
USE PDOException;
    class AttendanceModel{
        private PDO $pdo;
        public function __construct()
        {
            $this->pdo = Database::getInstance()->getConnection();
        }
        public function mark(int $classId, int $studentId, string $date, string $status){
            $sql ="INSERT INTO attendance(class_id, student_id, date_attendance, status) VALUES(?,?,?,?)";
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$classId,$studentId,$date,$status]);
        }

        public function findByStudentAndDate(int $studentId, string $date){
            $sql="SELECT id FROM attendance WHERE student_id = ? AND date_attendance =?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$studentId,$date]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ?: null;
        }
        public function getByStudent(int $studentId){

        $sql ="SELECT date_attendance, status FROM attendance WHERE student_id = ? ORDER BY date_attendance DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        

    }



?>