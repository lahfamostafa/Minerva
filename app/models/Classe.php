<?php

    class Classe{

        private ?int $id;
        private string $name;
        private int $teacherId;

        public function __construct(int $id, string $name, int $teacherId)
        {
            $this->id =$id;
            $this->name =$name;
            $this->teacherId = $teacherId;
            }

        public function getId(){
           return $this->id;
        }    
        public function getName(){
            return $this->name;
        }
        public function getTeacherId(){
            return $this->teacherId;
        }
    }