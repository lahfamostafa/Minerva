<?php
namespace App\services;

use App\core\BaseController;
use App\models\User;
use App\services\ClasseService;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dotenv\Dotenv;

    class AuthService{
        private User $UserModel;
        private ClasseService $ClassService;

        public function __construct(){
            $this->UserModel = new User();
            $this->ClassService = new ClasseService();
        }
        public function login(string $email, string $password){
            $email = trim($email);
            $password = trim($password);

            $user = $this->UserModel->findUserByEmail($email);
            if(!$user)
                throw new Exception("Email incorrect");
            if(!password_verify($password,$user['password']))
                throw new Exception("Mot de passe incorrect");

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            return $user;
            
        }

        public function register(string $nom , string $email, string $password,string $role){
            $user = $this->UserModel->findUserByEmail($email);
            if($user){
                throw new Exception("Email déja existe");
            }
            return $this->UserModel->create($nom , $email, $password , $role);
        }

        public function currentUser(){
            if(!isset($_SESSION['user_id'])) return null;
            return $this->UserModel->findUserById($_SESSION['user_id']);
        }

        public function storeTeacher($nom, $email, $password){
            return $this->register($nom, $email, $password,'teacher');
        }

        public function storeStudent($nom , $email , $classId){
            $NoHash = substr(md5(rand()), 0, 8);
            
            $studentId = $this->register($nom,$email,$NoHash,'student');
            $this->ClassService->assignStudent($studentId , $classId);
            $this->sendEmail($email, $NoHash);             
            return (int)$studentId;
        }

        public function sendEmail($email, $password){
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPAuth = true;
                $mail->isSMTP();
                $mail->Host = $_ENV['SMTP_HOST'];
                $mail->Username = $_ENV['SMTP_USER'];
                $mail->Password = $_ENV['SMTP_PASS'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom($_ENV['SMTP_USER'], $_ENV['SMTP_NAME']);
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Vos identifiants Minerva';
                $mail->Body = "
                    <h2>Bienvenue sur Minerva !</h2>
                    <p>Voici vos identifiants de connexion :</p>
                    <p><strong>Email :</strong> $email</p>
                    <p><strong>Mot de passe :</strong> $password</p>
                    <p>Connectez-vous sur : Minerva</p>
                ";

                $mail->send();
                return 'Email envoyé avec succès';
            } catch (Exception $e) {
                return "Erreur d envoi:" . $e->getMessage();
            }
        }

        public function logout(){
            $_SESSION = [];
            session_destroy();
        }
    }
    
?>