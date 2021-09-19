<?php

include_once './Db/Conexao.php';
include_once './Models/Usuario.php';
include_once './Db/IMysqlRepository.php';


class UserRepository implements IMysqlRepository
{
    protected $mysqlDB;

    public function __construct()
    {
        $this->mysqlDB = Conexao::getInstance();
    }

    public function findAll()
    {
    }

    public function findId($id)
    {
        $query = "select * from tb_usuarios where id_usuario = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Usuario($row[0]['id_usuario'], $row[0]['login'], $row[0]['nome'], $row[0]['email'], $row[0]['senha'], $row[0]['descricao'], $row[0]['dataAniversario'], $row[0]['dataInclusao']);
    }

    public function find($params)
    {
        $query = "select * from tb_usuarios where 1 = 1";
        foreach ($params as $key => $value) {
            $query = $query.' and '.$key.' = :'.$key; 
        }

        $stmt = $this->mysqlDB->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindParam(':'.$key, $value);
            echo ':'.$key.' '.$value;
        }

        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Usuario($row[0]['id_usuario'], $row[0]['login'], $row[0]['nome'], $row[0]['email'], $row[0]['senha'], $row[0]['descricao'], $row[0]['dataAniversario'], $row[0]['dataInclusao']);
    }

    public function insert($object)
    {
        try {
            $query = "insert into tb_usuarios(nome, email, login, senha, descricao, dataAniversario, dataInclusao) VALUES (:nome, :email, :login, :senha, :descricao, sysdate(), sysdate())";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':nome', $object->getNome());
            $stmt->bindParam(':email', $object->getEmail());
            $stmt->bindParam(':login', $object->getLogin());
            $stmt->bindParam(':senha', $object->getSenha());
            $stmt->bindParam(':descricao', $object->getDescricao());

            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function remove($id)
    {
        $query = "delete from tb_usuarios where id_usuario = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function update($params, $id)
    {
        $query = "update tb_usuarios set ";
        foreach ($params as $key => $value) {
            $query = $query.' '.$key.' = :'.$key.','; 
        }
        rtrim($query, ", ");

        $query = $query.' where id_usuario = '.$id;

        var_dump($query);
        exit;

        $stmt = $this->mysqlDB->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindParam(':'.$key, $value);
            echo ':'.$key.' '.$value;
        }

        $stmt->execute();
    }
}
