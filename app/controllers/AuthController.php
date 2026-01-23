<?php
    use App\services\AuthService;
    class AuthController extends \App\core\BaseController{

        private $auth;

        public function __construct(){
            $this->auth = new AuthService();
        }
        
        public function showLogin(){
            $this->render('auth','login',['error' => null]);
        }

        //post
        public function login(){
            try {
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                if($email ==='' || $password ===''){
                    throw new Exception('Email et mot de passe obligatoires');
                }
                    
                $user = $this->auth->login($email, $password);
                
                $role = strtolower($user['role']);

                if ($role !== 'teacher' && $role !== 'student') {
                    throw new Exception("Rôle invalide");
                }

                header("Location: " . BASE_URL . "/dashboard/".$role);
                exit;
            } catch (Exception $e) {
                $this->render('auth','login',['error' => $e->getMessage()]);
            }
        }
        
        public function showRegister(){
            $this->render('auth','register',['error' => null]);
        }
            
        public function registerTeacher(){
            try {
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                if($email ==='' || $password ==='' || $nom === ''){
                    throw new Exception('Tous les champs sont obligatoires');
                }

                $this->auth->storeTeacher($nom, $email, $password);

                header("Location: " . BASE_URL . "/dashboard/teacher");
                exit;

            } catch (Exception $e) {
                $this->render('auth','register',['error' => $e->getMessage()]);
            }
        }

        public function logout(){
            $this->auth->logout();
            header("Location: " . BASE_URL . "/login");
            exit;
        }

    }

?>