<?php
    use App\core\BaseController;
    class AuthController extends BaseController{
        
        public function login(){
            $this->render('auth','login');
        }
        public function register(){
<<<<<<< HEAD
            $this->render('register');
=======
            $this->render('auth','register');
>>>>>>> 45e20cfd6740c0121496f1084bfb2c6f3d9d6df6
        }

    }

?>