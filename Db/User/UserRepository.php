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
        $query = "select * from tb_usuarios u left join tb_imagem im on im.id_imagem = u.imagem_id  where u.id_usuario = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Usuario($row[0]['id_usuario'], $row[0]['login'], $row[0]['nome'], $row[0]['email'], $row[0]['senha'], $row[0]['descricao'], $row[0]['dataAniversario'], $row[0]['dataInclusao'], $row[0]['imagem']);
    }

    public function find($params)
    {
        $query = "select * from tb_usuarios u left join tb_imagem im on im.id_imagem = u.imagem_id where 1 = 1";
        foreach ($params as $key => &$value) {
            $query = $query . ' and ' . $key . ' = :' . $key;
        }

        $stmt = $this->mysqlDB->prepare($query);

        foreach ($params as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }

        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        if ($stmt->rowCount() > 0) {
            return new Usuario($row[0]['id_usuario'], $row[0]['login'], $row[0]['nome'], $row[0]['email'], $row[0]['senha'], $row[0]['descricao'], $row[0]['dataAniversario'], $row[0]['dataInclusao'],$row[0]['imagem']);
        }

        return $result;
        //
    }

    public function insert($object)
    {
        try {
            $query = "insert into tb_usuarios(nome, email, login, senha, descricao, dataAniversario, dataInclusao) VALUES (:nome, :email, :login, :senha, :descricao, sysdate(), sysdate())";

            $nome = $object->getNome();
            $email = $object->getEmail();
            $login = $object->getLogin();
            $senha = $object->getSenha();
            $descricao = $object->getDescricao();

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':descricao', $descricao);

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
        try {
            $query = "update tb_usuarios set ";
            foreach ($params as $key => &$value) {
                $query = $query . ' ' . $key . ' = :' . $key . ',';
            }
            $query = rtrim($query, ",");

            $query = $query . ' where id_usuario = ' . $id;
            $stmt = $this->mysqlDB->prepare($query);

            //& tem que passar por ref 
            foreach ($params as $key => &$value) {
                $stmt->bindParam(':' . $key, $value);
            }

            $stmt->execute();
            if ($stmt->rowCount() <= 0)
                return false;
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function SearchUsers($name, $id){
        $query = "SELECT
        u.id_usuario,
        u.nome,
        u.descricao,
        im.imagem,
            nvl((
            SELECT
                1
            FROM
                tb_amizade ta
            WHERE
                ta.usuario_id = :id AND ta.amigo_id = u.id_usuario
                and ta.dataAceite is null 
                and ta.dataSolicitacao is not null
        ),0) AS sol_pend,
         nvl((
            SELECT
                1
            FROM
                tb_amizade ta
            WHERE
                ta.usuario_id = :id AND ta.amigo_id = u.id_usuario
                and ta.dataAceite is not null 
        ),0) AS amigo
        
        FROM
            tb_usuarios u
        LEFT JOIN tb_imagem im ON im.id_imagem = u.imagem_id
        WHERE
            u.id_usuario <> :id
            and u.nome like :nome
            ";
            
       // $query = "select * from tb_usuarios t where t.nome like :nome";
        $stmt = $this->mysqlDB->prepare($query);
        $param = $name . "%";
        $stmt->bindParam(':nome', $param);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach($row as $linha){
            $result[] = (object)[
                "nome" => $linha['nome'],
                "id_usuario" => $linha['id_usuario'],
                "descricao" => $linha['descricao'],
                "sol_pend" => $linha['sol_pend'],
                "amigo" => $linha['amigo'],
                "imagem" => $linha['imagem']
            ];
        }
        return $result;
    }

    public function GetFriendsPend($id){
        $query = "SELECT
        u.id_usuario,
        u.nome,
        u.descricao,
        a.amigo_id,
        im.imagem
    FROM
        tb_amizade a
    INNER JOIN tb_usuarios u ON
        u.id_usuario = a.usuario_id
    LEFT JOIN tb_imagem im ON im.id_imagem = u.imagem_id
    WHERE
        amigo_id = :id AND a.dataSolicitacao IS NOT NULL AND a.dataAceite IS NULL
            ";
            
       // $query = "select * from tb_usuarios t where t.nome like :nome";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach($row as $linha){
            $result[] = (object)[
                "nome" => $linha['nome'],
                "id_usuario" => $linha['id_usuario'],
                "descricao" => $linha['descricao'],
                "amigo_id" => $linha['amigo_id'],
                "imagem" => $linha['imagem']
            ];
        }
        return $result;
    }

    public function GetNumberSolPed($id){
        $query = "SELECT
        count(*) as total
    FROM
        tb_amizade a
    INNER JOIN tb_usuarios u ON
        u.id_usuario = a.usuario_id
    WHERE
        amigo_id = :id AND a.dataSolicitacao IS NOT NULL AND a.dataAceite IS NULL
            ";
            
       // $query = "select * from tb_usuarios t where t.nome like :nome";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        $result = $row['total'];
        return $result;
    }

    public function AcceptInvite($id_origem, $id_destino){
        try {
            $query = "
            INSERT INTO tb_amizade(
                usuario_id,
                amigo_id,
                dataSolicitacao,
                dataAceite
            )
            VALUES(
                :id_usuario,
                :amigo_id,
                SYSDATE(), 
                SYSDATE()
            )";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_usuario', $id_origem);
            $stmt->bindParam(':amigo_id', $id_destino);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }

        try {
            $query = "
        UPDATE
            tb_amizade a
        SET
            a.dataAceite = SYSDATE()
        WHERE
            a.amigo_id = :amigo_id AND a.usuario_id = :id_origem";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_origem', $id_destino);
            $stmt->bindParam(':amigo_id', $id_origem);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }
    public function InviteUser($id_origem, $id_destino){
        try {
            $query = "
            INSERT INTO tb_amizade(
                usuario_id,
                amigo_id,
                dataSolicitacao
            )
            VALUES(
                :id_usuario,
                :amigo_id,
                SYSDATE()
            )";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_usuario', $id_origem);
            $stmt->bindParam(':amigo_id', $id_destino);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function UndoUser($id_origem, $id_destino){
        try {
            $query = "
            DELETE
            aa.*
        FROM
            tb_amizade aa
        WHERE
            aa.id_solicitacao IN(
            SELECT
                id_solicitacao
            FROM
                (
                SELECT
                    a.id_solicitacao
                FROM
                    tb_amizade a
                WHERE
                    a.usuario_id = :id_origem AND a.amigo_id = :id_destino AND a.dataAceite IS NOT NULL
                UNION ALL
            SELECT
                a.id_solicitacao
            FROM
                tb_amizade a
            WHERE
                a.usuario_id = :id_destino AND a.amigo_id = :id_origem AND a.dataAceite IS NOT NULL
            ) X
        )";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_origem', $id_origem);
            $stmt->bindParam(':id_destino', $id_destino);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function setUserImage($nome, $image){
        $query = "insert into tb_imagem(titulo, imagem) VALUES (:titulo, :image)";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':titulo', $nome);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        $custId = $this->mysqlDB->lastInsertId();
        $stmt->closeCursor();
        return $custId;
    }

    public function getUserImage($id){
        $query = "select im.imagem from tb_usuarios u left join tb_imagem im on im.id_imagem = u.imagem_id  where u.id_usuario = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        return $linha["imagem"];
    }
}
