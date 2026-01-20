<?php
    class attendance{
        private PDO $pdo;
        public function __construct()
        {
            $this->pdo = $pdo;
        }
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getStudentId(): int
        {
            return $this->studentId;
        }
        public function getClassId(): string
        {
            return $this->classId;
        }
        public function getDateAttendance(): string
        {
            return $this->dateAttendance;
        }
        public function getStatus(): bool
        {
            return $this->status;
        }

    }



?>