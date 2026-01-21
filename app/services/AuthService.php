<?php
namespace App\services;


use Exception;
use App\models\User;
    class AuthService{
        public $UserModel;
        public $StudentModel;
        public $TeacherModel;

        public function __construct(){
            $this->UserModel = new User();
            // $this->StudentModel = new Student();
            // $this->TeacherModel = new Teacher();
        }
        public function login(string $email, string $password){
            $user = $this->userModel->findUserByEmail($email);
            if(!$user)
                {return['success' => false,'message' => 'Email incorrect'];
            }
            if(!password_verify($password,$user['password'])){
                return['success' =>false,'message' => 'Mot de passe incorrect'];
            }

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['email'] = $row['email'];
            
        }

        public function register(string $nom , string $email, string $password){
            $row = $this->UserModel->findUserByEmail($email);
            if($row && $row['email'] === $email){
                throw new Exception("Email déja existe");
            }
            $this->UserModel->create($nom , $email, $password , 'teacher');
        }

        public function currentUser(){
            if(!isset($_SESSION['user_id'])) return null;
            return $this->UserModel->findUserById($_SESSION['user_id']);
        }

        public function logout(){
            session_destroy();
            $_SESSION = [];
        }
    }
    
?>