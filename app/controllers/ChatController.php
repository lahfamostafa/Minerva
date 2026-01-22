<?php

use App\Services\ChatService;

class chatMessageController
{
    private ChatService $chatService;

    public function __construct()
    {
        $this->chatService = new ChatService();
    }


    public function store(){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        try{
            $classId = $_POST['class_id'];
            $message = $_POST['message'];
            $userId = $_POST['user_id'];

            $this->chatService->sendMessage($classId,$message,$userId);

            header("Location: /class/$classId/chat");
            exit;
            }catch(Exception $e){

                echo $e->getMessage();
            }
    }

    public function show($classId){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        $message = $this->chatService->getClassMessages($classId);

        require '../app/views/chat/class_chat.php';
        }
    }
    
