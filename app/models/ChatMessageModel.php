<?php
namespace App\Models;
use App\core\Database;
USE PDO;
use PDOException;


class ChatMessageModel{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function create(int $classId, int $userId, string $message){
        $sql='INSERT INTO chat_messages(class_id,user_id,message) VALUES(?,?,?)';
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$userId,$classId,$message]); 
    }
    public function getByClass(int $classId){
        $sql='SELECT cm.message, cm.creates_at , u.name FROM chat_messaged cm JOIN users u ON cm.user_id = u.id WHERE cm.class_id = ? ORDER BY cm.created_at ASC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}