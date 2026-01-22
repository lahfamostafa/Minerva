<?php

use app\core\BaseController;
use App\models\User;
use App\services\AuthService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dotenv\Dotenv;

    class UserController extends BaseController {
        public $UserModel ; 
        public $authService;
        
        public function __construct(){
            $this->UserModel = new User();
            $this->authService = new AuthService();
        }


        public function storeTeacher(){
            $result = $this->authService->register($_POST['nom'] , $_POST['email'] ,$_POST['password'],'teacher');
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render('teacher','register',compact('error'));
                exit;
            }

            header('Location: '.BASE_URL.'teacher/dashboard.php');    
            exit;        
        }

        public function storeStudent(){
            $NoHash = substr(md5(rand()), 0, 8);
            $result = $this->authService->register($_POST['nom'],$_POST['email'],$NoHash,'student');
            if($result == "EMAIL_EXIST"){
                $error = "Email déja existe";
                $this->render('student','register',compact('error'));
                exit;
            }

            
            $this->sendEmail($_POST['email'], $NoHash);

            header('Location: '.BASE_URL.'student/dashboard.php');
            echo $NoHash;
            exit;        
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
    }
    
?>