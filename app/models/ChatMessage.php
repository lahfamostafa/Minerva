<?php
    class ChatMessage{
        private ?int $id;
        private int $classId;
        private int $user_id;
        private string $message;
        private string $created_at;

        public function __construct(?int $id, int $classId, int $user_id, string $message, string $created_at)
        {
            $this->id = $id;
            $this->classId = $classId;
            $this->user_id = $user_id;
            $this->message = $message;
            $this->created_at = $created_at;
        }
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getClassId(): int
        {
            return $this->classId;
        }
        public function getUserId(): int
        {
            return $this->user_id;
        }
        public function getMessage(): string
        {
            return $this->message;
        }
        public function getCreatedAt(): string
        {
            return $this->created_at;
        }
    }



?>