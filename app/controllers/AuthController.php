<?php
    use App\core\BaseController;
    class AuthController extends BaseController{
        
        public function login(){
            $this->render('auth','login');
        }
        public function register(){
            $this->render('auth','register');
        }

    }

?>