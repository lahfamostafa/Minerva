<?php
    class ChatMessage{
        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getInstance()->getConnection();
        }

        public function createMessage(array $data){
            $sql="INSERT INTO chat_messages (user_id,content,created_at) VALUES(?,?,?)";
            $stmt=$this->pdo->prepare($sql);
           return $stmt->execute([$data['user_id'],$data['content'],$data['created_at']]);
        }
        public function getMessagesByUserId(int $userId){
            $sql="SELECT * FROM chat_messages WHERE user_id=?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getAllMessages(){
            $sql="SELECT * FROM chat_messages";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function deleteMessage(int $id){
            $sql="DELETE FROM chat_messages WHERE id=?";
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        }
        public function updateMessage(int $id,string $content){
            $sql="UPDATE chat_messages SET content=? WHERE id=?";
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$content,$id]);
        }
        public function getMessageById(int $id){
            $sql="SELECT * FROM chat_messages WHERE id=?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getMessagesByDateRange(string $startDate, string $endDate){
            $sql="SELECT * FROM chat_messages WHERE created_at BETWEEN ? AND ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$startDate,$endDate]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getMessagesByKeyword(string $keyword){
            $sql="SELECT * FROM chat_messages WHERE content LIKE ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute(['%'.$keyword.'%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getRecentMessages(int $limit){
            $sql="SELECT * FROM chat_messages ORDER BY created_at DESC LIMIT ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$limit]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getMessagesByUserAndDate(int $userId, string $date){
            $sql="SELECT * FROM chat_messages WHERE user_id=? AND DATE(created_at)=?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$userId,$date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function countMessagesByUser(int $userId){
            $sql="SELECT COUNT(*) as message_count FROM chat_messages WHERE user_id=?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$userId]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result['message_count'];
        }
        public function deleteMessagesByUser(int $userId){
            $sql="DELETE FROM chat_messages WHERE user_id=?";
            $stmt=$this->pdo->prepare($sql);
            return $stmt->execute([$userId]);
        }
        public function getMessagesWithPagination(int $limit, int $offset){
            $sql="SELECT * FROM chat_messages ORDER BY created_at DESC LIMIT ? OFFSET ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute([$limit,$offset]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function searchMessagesByContent(string $searchTerm){
            $sql="SELECT * FROM chat_messages WHERE content LIKE ?";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute(['%'.$searchTerm.'%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }



?>