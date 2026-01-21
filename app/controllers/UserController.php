<?php
    class UserController{
        private $UserService ; 

        public function __construct(){
            $this->UserService = new User();
        }

        public function storeUser(){
            $this->UserService->create($_POST);
        }
    }
?>