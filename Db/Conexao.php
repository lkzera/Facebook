<?php 

    class Conexao{

        public static $instance;

        private function __construct(){

        }

        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new PDO('mysql:host=localhost:3306;dbname=facebook', 'root','root');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }

            return self::$instance;
        }

        public function lastInsertId(){
            return $this->instance->lastInsertId();
        }

    }

?>