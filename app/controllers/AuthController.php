<?php
    use App\core\BaseController;
    class AuthController extends BaseController{
        
        public function login(){
            $this->render('login');
        }

        public function register(){
            $this->render('register');
        }

    }

?>