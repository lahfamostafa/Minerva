<?php
namespace App\Models;
use App\core\Database;
USE PDO;
USE PDOException;
    class AttendanceModel{
        private PDO $pdo;
        public function __construct(){
            $this->pdo = Database::getInstance()->getConnection();
        }

        public function mark(int $classId, int $studentId, string $date){
            $sql ="INSERT INTO attendance(class_id, student_id, date_attendance) VALUES(?,?,?)";
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$classId,$studentId,$date]);
        }

        public function findByStudentAndDate(int $studentId, int $classId, string $date){
            $sql="SELECT id FROM attendance WHERE student_id = ? AND class_id = ? AND date_attendance = ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$studentId, $classId, $date]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ?: null;
        }

        public function getStatus(int $classId, int $studentId, string $date){
            $sql ="SELECT status FROM attendance WHERE class_id = ? and student_id = ? and date_attendance = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$classId , $studentId ,$date]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row['status'] ?? null ;
        }
        
        public function updateAbsence(int $classId , int $studentId , string $date , string $status){
            $sql ="update attendance set status = ? where date_attendance = ? and student_id = ? and class_id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$status , $date , $studentId , $classId]);
        }
    }
?>