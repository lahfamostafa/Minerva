<?php
    class User{
        private ?int $id;
        private string $name;
        private string $email;
        private string $password;
        private string $role;
        private ?DateTime $created_at;

        public function __construct(?int $id,string $name, string $email, string $password, string $role,?DateTime $created_at)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->created_at = $created_at;
        }
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getName(): string
        {
            return $this->name;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(): string
        {
            return $this->password;
        }
        public function getRole(): string
        {
            return $this->role;
        }
        public function getCreatedAt(): ?DateTime
        {
            return $this->created_at;
        }





    }


?>