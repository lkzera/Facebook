<?php

include_once './Db/Conexao.php';
include_once './Models/Usuario.php';
include_once './Db/IMysqlRepository.php';


    class UserRepository implements IMysqlRepository
    {
        protected $mysqlDB;

        public function __construct(){
            $this->mysqlDB = Conexao::getInstance();
        }

        public function findAll()
        {
            
        }

        public function findId($id)
        {
           
        }

        public function find($object)
        {
            $query = "select * from tb_usuarios where login = :login";
            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':login',$object);
    
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return new Usuario($row[0]['id_usuario'], $row[0]['login'], $row[0]['nome'], $row[0]['email'], $row[0]['senha'], $row[0]['descricao'], $row[0]['dataAniversario'], $row[0]['dataInclusao']);
        }

        public function insert($object)
        {
            
        }

        public function remove($id)
        {
            
        }

        public function update($update)
        {
            
        }
    }


?>