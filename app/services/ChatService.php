<?php

namespace App\Services;

use App\Models\ChatMessageModel;
use Exception;

class ChatService
{

    private ChatMessageModel $chatMessageModel;

    public function __construct()
    {
        $this->chatMessageModel = new ChatMessageModel();
    }

    public function sendMessage(int $classId, int $userId, string $message){
        if(empty(trim($message))){
            throw new Exception("Le message ne peut pas etre vide");
        }
        return $this->chatMessageModel->create($classId,$userId, $message);
    }
    public function getClassMessages(int $classId){
        return $this->chatMessageModel->getByClass($classId);
    }
}
