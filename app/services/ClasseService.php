<?php
namespace App\services;

use App\models\Classe;

use Exception;
use PDO;
use PDOException;

class ClasseService
{

    private Classe $classeModel;

    public function __construct()
    {
        $this->classeModel = new Classe();
    }

    public function createClass(string $name, int $teacherId){
        if(empty($name)){
            throw new Exception("Le nom de la classe est obligatoire");
        }
        return $this->classeModel->createClasse([
            'name' => $name,
            'teacher_id' => $teacherId
        ]);
    }
    public function assignStudent(int $studentId, int $classId){
        if($studentId <= 0 || $classId <=0){
            throw new Exception("Données invalides");
        }
        return $this->classeModel->assignStudent($studentId, $classId);
    }

    public function getTeacherClass(int $teacherId){
        return $this->classeModel->getClassByTeacherId($teacherId);
    }

    public function getClassStudent(int $classId){
        return $this->classeModel->getStudents($classId);
    }
    public function getStudentClass(int $studentId){
        return $this->classeModel->getClassByStudent($studentId);
    }
    public function getTeacherClasses(int $teacherId){
        return $this->getTeacherClass($teacherId);
    }
}
