<?php

    namespace App\core;
    use Classe;
    use PDO;
    use PDOException;

    class ClasseService {
        
        private Classe $classeModel;

        public function __construct()
        {
            $this->classeModel = new Classe();
        }

        public function getAllClasses(){
            return $this->classeModel->getAllClasses();
        }
        public function getClassById($id){
            return $this->classeModel->getClassById($id);
        }
        public function getClassesByTeacherId($teacherId){
            return $this->classeModel->getClassesByTeacherId($teacherId);
        }

        public function deleteClass($id){
            $this->classeModel->deleteClass($id);
        }
        public function updateClass($id, $data){
            $this->classeModel->updateClass($id, $data);
        }
        public function assignStudentToClass($studentId, $classId){
            $this->classeModel->assignStudentToClass($studentId, $classId);
        }
        public function removeStudentFromClass($studentId){
            $this->classeModel->removeStudentFromClass($studentId);
        }
        public function getStudentsInClass($classId){
            return $this->classeModel->getStudentsInClass($classId);
        }
        public function getTeachersOfClass($classId){
            return $this->classeModel->getTeachersOfClass($classId);
        }
        public function addTeacherToClass($teacherId, $classId){
            $this->classeModel->addTeacherToClass($teacherId, $classId);
        }
        public function removeTeacherFromClass($teacherId, $classId){
            $this->classeModel->removeTeacherFromClass($teacherId, $classId);
        }

        public function createClass($data){
            $this->classeModel->createClass($data);
        }
        public function createClasse($data){
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("INSERT INTO classes (name, teacher_id) VALUES (:name, :teacher_id)");
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':teacher_id', $data['teacherId']);
            $stmt->execute();
            }

    
        }




?>