<?php

include_once './Db/Conexao.php';
include_once './Models/Post.php';
include_once './Db/IMysqlRepository.php';


class PostRepository implements IMysqlRepository
{
    protected $mysqlDB;

    public function __construct()
    {
        $this->mysqlDB = Conexao::getInstance();
    }

    public function findAll()
    {
        $query = "select * from tb_postagem;";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        foreach($row as $linha){
            $result += new Post($linha['id_postagem'],$linha['dataPostagem'], $linha['texto']);
        }

        return $result;
       
    }

    public function findId($id)
    {
        $query = "select * from tb_postagem where id_postagem = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Post($row[0]['id_postagem'],$row[0]['dataPostagem'], $row[0]['texto']);
    }

    public function find($params)
    {
        $query = "select * from tb_postagem where 1 = 1";
        foreach ($params as $key => &$value) {
            $query = $query . ' and ' . $key . ' = :' . $key;
        }

        $stmt = $this->mysqlDB->prepare($query);

        foreach ($params as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }

        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Post($row[0]['id_postagem'],$row[0]['dataPostagem'], $row[0]['texto']);
    }

    public function insert($object)
    {
        try {
            $query = "insert into tb_postagem(dataPostagem, texto) VALUES (sysdate(), :texto)";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':texto', $object->getTexto());

            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function remove($id)
    {
        $query = "delete from tb_postagem where id_postagem = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function update($params, $id)
    {
        try {
            $query = "update tb_postagem set ";
            foreach ($params as $key => &$value) {
                $query = $query . ' ' . $key . ' = :' . $key . ',';
            }
            $query = rtrim($query, ",");

            $query = $query . ' where id_postagem = ' . $id;
            $stmt = $this->mysqlDB->prepare($query);

            //& tem que passar por ref 
            foreach ($params as $key => &$value) {
                $stmt->bindParam(':'.$key, $value);
            }

            $stmt->execute();
            if($stmt->rowCount() <= 0 )
                return false;
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
