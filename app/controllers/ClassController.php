<?php

    
    class ClassController {

        public $classService;

        public function __construct(){
            $this->classService = new ClassService;
        }

        public function store(){
            $nom = $_POST['nom'];
            $teacherId = $_POST['user_id'];

            $data = ['name' => $nom,'teacherId' => $teacherId];

            $classe = new Classe();
            $classe->createClasse($data);
        }
    }
?>