<?php
namespace App\Models;
USE PDO;
USE PDOException;

USE App\core\Database;

    class Classe{
        private PDO $pdo;
        public function __construct(){
            $this->pdo = Database::getInstance()->getConnection();
        }

        public function createClasse(array $data){
            $sql='INSERT INTO classes (name,teacher_id) VALUES(?,?)';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$data['name'],$data['teacherId']]);
        }

        public function findClassById(int $id){
            $sql='SELECT * FROM classes WHERE id=?';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function assignStudent(int $studentId, int $classId){
            $sql='INSERT INTO student_class(student_id, class_id) VALUES(?,?)';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$studentId, $classId]);
        }

        public function getClassByTeacherId(int $teacherId){
            $sql = "SELECT * FROM classes WHERE teacher_id = ?";
            $stmt =$this->pdo->prepare($sql);
            $stmt->execute([$teacherId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getStudents(int $classId){
            $sql ="SELECT u.* , c.name as nom_classe from users u join student_class sc on sc.student_id = u.id join classes c on sc.class_id = c.id where sc.class_id = ?";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([$classId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getClassByStudent(int $studentId){
            $sql = "SELECT c.* FROM classes c JOIN student_class sc ON c.id = sc.class_id WHERE sc.student_id =?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$studentId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getTeacherClasse($user_id){
            $sql="SELECT c.* , u.name as userName FROM classes c JOIN users u ON c.teacher_id=u.id WHERE teacher_id = ? and u.role = 'teacher'";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
        public function updateAssignemant(int $studentId, int $classId){
            $sql="update student_class set class_id = ? where student_id = ?";
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$classId , $studentId]);
        }
    }
?>