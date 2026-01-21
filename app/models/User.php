<?php
namespace App\models;
use App\core\Database;
use PDO;

    class User{
        private PDO $pdo;

        public function __construct(){
            $this->pdo = Database::getInstance()->getConnection();
        }

        public function create(string $nom , string $email, string $password , string $role){
            $stm = $this->pdo->prepare("insert into users (name , email , password , role) values (?,?,?,?)");
            // if($role === "student"){
            //     email....
            // }
            $hashed = password_hash($password , PASSWORD_BCRYPT);
            return $stm->execute([$nom , $email , $hashed , $role]);
        }

        public function findUserById(int $id){
            $stm = $this->pdo->prepare("select * from users where id = ?");
            $stm->execute([$id]);
            $row = $stm->fetch(PDO::FETCH_ASSOC);

            return $row ?: null;
        }

        public function findUserByEmail(string $email){
            $stm = $this->pdo->prepare("select * from users where email = ?");
            $stm->execute([$email]);
            $row = $stm->fetch(PDO::FETCH_ASSOC);

            return $row ?: null;
        }

        public function delete(int $id){
            $stm = $this->pdo->prepare("delete from users where id = ?");
            return $stm->execute([$id]);
        }
        
    }
?>