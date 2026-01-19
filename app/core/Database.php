<?php


    class Database{

        private PDO $pdo;
        private static ?Database $instance = null;

        private function __construct()
        {
            try{
                $config = require __DIR__.'/../../Config/DatabaseInfos.php';
                $this->pdo = new PDO('mysql:host='.$config['host'].
                ';dbname ='.$config['dbname'],
                 $config['user'],
                  $config['pass']);

            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                die('Connection Failed'  . $e->getMessage());
            }
        }

        public static function getInstance(){
            if(self::$instance === null){
                self::$instance = new database();
            }
            return self::$instance;
        }
        public function getConnection(){
            return $this->pdo;
        }
    }



?>