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
                $row = $stmt->fetch();

                if($stmt->rowCount() <= 0)
                    return "DEU RUIM";

                return new Usuario($row[0],$row[1],$row[2],$row[3], $row[4], $row[5], $row[6], $row[7]);

            } catch(Exception $ex){
                    echo $ex->getMessage();
            }

        }

    }