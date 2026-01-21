<?php

    class Classe{

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getInstance()->getConnection();
        }
        public function createClasse(array $data){
            $sql='INSERT INTO classes (name,teacherId) VALUES(?,?)';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$data['name'],$data['teacherId']]);
        }
        public function getAllClasses(){
            $sql='SELECT * FROM classes';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function findById(int $id){
            $sql='SELECT * FROM classes WHERE id=?';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function updateClasse(int $id,array $data){
            $sql='UPDATE classes SET name=?, description=? WHERE id=?';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$data['name'],$data['description'],$id]);
        }
        public function deleteClasse(int $id){
            $sql='DELETE FROM classes WHERE id=?';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        }
        public function findByName(string $name){
            $sql='SELECT * FROM classes WHERE name=?';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$name]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function searchClasses(string $keyword){
            $sql='SELECT * FROM classes WHERE name LIKE ? OR description LIKE ?';
            $stmt=$this->pdo->prepare($sql);
            $likeKeyword = "%$keyword%";
            $stmt->execute([$likeKeyword, $likeKeyword]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function countClasses(){
            $sql='SELECT COUNT(*) as total FROM classes';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }
        public function getClassesWithStudentCount(){
            $sql='SELECT c.*, COUNT(s.id) as student_count 
                  FROM classes c 
                  LEFT JOIN students s ON c.id = s.class_id 
                  GROUP BY c.id';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function assignTeacherToClass(int $classId, int $teacherId){
            $sql='UPDATE classes SET teacher_id=? WHERE id=?';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$teacherId,$classId]);
        }
        public function getClassesByTeacherId(int $teacherId){
            $sql='SELECT * FROM classes WHERE teacher_id=?';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$teacherId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function removeTeacherFromClass(int $classId){
            $sql='UPDATE classes SET teacher_id=NULL WHERE id=?';
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$classId]);
        }
        public function getClassesWithoutTeacher(){
            $sql='SELECT * FROM classes WHERE teacher_id IS NULL';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getClassesWithTeachers(){
            $sql='SELECT c.*, u.name as teacher_name 
                  FROM classes c 
                  LEFT JOIN users u ON c.teacher_id = u.id';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getClassesByStudentId(int $studentId){
            $sql='SELECT c.* 
                  FROM classes c 
                  JOIN students s ON c.id = s.class_id 
                  WHERE s.id = ?';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$studentId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }   
        public function getClassCountByTeacherId(int $teacherId){
            $sql='SELECT COUNT(*) as class_count FROM classes WHERE teacher_id=?';
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$teacherId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['class_count'];
        }
        
    }