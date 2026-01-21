<?php

use App\core\Database;
    class User{
        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getInstance()->getConnection();
        }

        public function createUser(array $data){
            $sql="INSERT INTO users (name,email,password,role) VALUES(?,?,?,?)";
            $stmt=$this->pdo->prepare($sql);
           return $stmt->execute([$data['name'],$data['email'],$data['password'],$data['role']]);
        }

        public function updateUser(array $data){
            $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $stmt= $this->pdo->prepare($sql);
           return $stmt->execute([$data['name'],$data['email'],$data['id']]);
        }

        public function findById(int $id){
            $sql="SELECT * FROM users WHERE id= ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findUserByEmail($email){
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
            
        public function getUsers(){
            $sql="SELECT * FROM users";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        


        




    }


?>