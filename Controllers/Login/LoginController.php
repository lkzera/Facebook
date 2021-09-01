<?php
include_once "./Db/Conexao.php";
include_once "./Models/Usuario.php";

    class LoginController{

        public function ValidaLogin($email,$senha){
            
            try{
                $MysqlPDO = Conexao::getInstance();
                $query = "select * from tb_usuarios";
        
                $stmt = $MysqlPDO->prepare($query);
        
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_CLASS, "Usuario");
                return $row;

            } catch(Exception $ex){
                    echo $ex->getMessage();
            }

        }

    }