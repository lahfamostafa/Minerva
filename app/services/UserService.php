<?php
namespace App\services;
use App\Models\User;
use App\Models\Student;
    class UserService{
        private User $userModel;
        private Student $StudentModel;
        public function __construct(){
            $this->userModel = new User();
            $this->StudentModel = new student();
        }

        public function removeStudent($studentId){
            return $this->userModel->delete($studentId);
        }

        public function findUserById($id){
            return $this->userModel->findUserById($id);
        }

        public function updateStudent(int $studentId , string $name){
            return $this->StudentModel->updateStudent($studentId , $name);
        }
        

    }
?>