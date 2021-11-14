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
        $query = "select p.id_postagem,p.dataPostagem,p.texto,u.id_usuario, u.nome from tb_postagem p inner join tb_usuarios u on p.id_usuario = u.id_usuario order by p.dataPostagem desc";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        foreach($row as $linha){
            
            $result[] = (object)[
               "id_postagem" => $linha['id_postagem'],
               "dataPostagem" => $linha['dataPostagem'],
               "texto" => $linha['texto'],
               "id_usuario" => $linha['id_usuario'],
               "nome_usuario" => $linha["nome"]
            ];
        }

        return $result;
       
    }

    public function findId($id)
    {
        $query = "select p.id_postagem,p.dataPostagem,p.texto,u.id_usuario, u.nome from tb_postagem p inner join tb_usuarios u on p.id_usuario = u.id_usuario where p.id_postagem = :id";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        return $result[] = (object)[
            "id_postagem" => $row[0]['id_postagem'],
            "dataPostagem" => $row[0]['dataPostagem'],
            "texto" => $row[0]['texto'],
            "id_usuario" => $row[0]['id_usuario'],
            "nome_usuario" => $row[0]["nome"]
        ];
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
        $result = [];
        return $result[] = (object)[
            $row[0]['id_postagem'],
            $row[0]['dataPostagem'],
            $row[0]['texto'],
            $row[0]['id_usuario']
        ];
    }

    public function insert($object)
    {
        try {
            $query = "insert into tb_postagem(dataPostagem, texto, id_usuario) VALUES (sysdate(), :texto, :id_usuario)";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':texto', $object->getTexto());
            $stmt->bindParam(':id_usuario', $object->getId_usuario());

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

        if ($stmt->rowCount() > 0){
            return true;
        }
        
        return false;
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

    public function findPostsFriends($id, $page){
        
        $query = "
    SELECT
        p.id_postagem,
        p.dataPostagem,
        p.texto,
        u.id_usuario,
        u.nome,
        ceil(count(p.id_postagem) over() / 5) as pages
    FROM
        tb_postagem p
    INNER JOIN tb_usuarios u ON
        p.id_usuario = u.id_usuario
    WHERE
        p.id_usuario IN(
            (
            SELECT
                a.amigo_id AS amigo_id
            FROM
                tb_amizade a
            WHERE
                a.usuario_id = :id AND a.dataAceite IS NOT NULL AND a.dataBloqueio IS NULL
            UNION ALL
        SELECT
            :id AS amigo_id
        FROM DUAL
        )
    ) order by dataPostagem desc
    limit 5 OFFSET ".$page;

        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindValue(':id', $id);
        //$stmt->bindValue(':page', $page);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        foreach($row as $linha){
            
            $result[] = (object)[
               "id_postagem" => $linha['id_postagem'],
               "dataPostagem" => $linha['dataPostagem'],
               "texto" => $linha['texto'],
               "id_usuario" => $linha['id_usuario'],
               "nome_usuario" => $linha["nome"],
               "pages" => $linha["pages"]
            ];
        }

        return $result;
    }
}
