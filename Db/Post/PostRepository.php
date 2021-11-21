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

        foreach ($row as $linha) {

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
        $query = "select p.id_postagem,p.dataPostagem,p.texto,u.id_usuario, u.nome, im.imagem, (select im2.imagem from tb_imagem im2 where im2.id_imagem = p.id_imagem) as post_img from tb_postagem p inner join tb_usuarios u on p.id_usuario = u.id_usuario left join tb_imagem im on im.id_imagem = u.imagem_id where p.id_postagem = :id";
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
            "nome_usuario" => $row[0]["nome"],
            "imagem" => $row[0]["imagem"],
            "post_img" => $row[0]["post_img"]
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

            $texto =  $object->getTexto();
            $id_usuario = $object->getId_usuario();
            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':texto', $texto);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
            $custId = $this->mysqlDB->lastInsertId();
            $stmt->closeCursor();
            return $custId;
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

        if ($stmt->rowCount() > 0) {
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

    public function findPostsFriends($id, $page)
    {

        $query = "
    SELECT
        p.id_postagem,
        p.dataPostagem,
        p.texto,
        u.id_usuario,
        u.nome,
        im.imagem as imagem_usuario,
        (select im2.imagem from tb_imagem im2 where im2.id_imagem = p.id_imagem) as post_img,
        ceil(count(p.id_postagem) over() / 5) as pages,
        (select count(*) from tb_reacao r where r.postagem_id = p.id_postagem) as curtidas,
        (select count(*) from tb_comentarios tc where tc.postagem_id = p.id_postagem) as comentarios,
        (select count(*) from tb_reacao r where r.postagem_id = p.id_postagem and r.usuario_id = :id) as curtido
    FROM
        tb_postagem p
    INNER JOIN tb_usuarios u ON
        p.id_usuario = u.id_usuario
    LEFT JOIN tb_imagem im on im.id_imagem = u.imagem_id
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
    limit 5 OFFSET " . $page;

        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindValue(':id', $id);
        //$stmt->bindValue(':page', $page);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        foreach ($row as $linha) {

            $result[] = (object)[
                "id_postagem" => $linha['id_postagem'],
                "dataPostagem" => $linha['dataPostagem'],
                "texto" => $linha['texto'],
                "id_usuario" => $linha['id_usuario'],
                "nome_usuario" => $linha["nome"],
                "pages" => $linha["pages"],
                "curtidas" => $linha["curtidas"],
                "comentarios" => $linha["comentarios"],
                "curtido" => $linha["curtido"],
                "imagem_usuario" => $linha["imagem_usuario"],
                "post_img" => $linha["post_img"]
            ];
        }

        return $result;
    }

    public function CurtirPost($usuario_id, $post_id)
    {
        try {
            $query = "INSERT INTO tb_reacao (id_recao, usuario_id, postagem_id, dataInclusao, tipo_reacao_id) VALUES (NULL, :id_usuario, :id_post, current_timestamp(), '1')";
            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_usuario', $usuario_id);
            $stmt->bindParam(':id_post', $post_id);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function DescurtirPost($usuario_id, $post_id)
    {
        try {
            $query = "delete from tb_reacao where usuario_id = :id_usuario and postagem_id = :id_post";
            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_usuario', $usuario_id);
            $stmt->bindParam(':id_post', $post_id);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function GetComentarios($post_id)
    {
        try {
            $query = "SELECT
            t.id_comentario,
            t.usuario_id_env,
            t.dataInclusao,
            t.texto,
            u.nome,
            im.imagem
        FROM
            tb_comentarios t
        INNER JOIN tb_usuarios u ON
            u.id_usuario = t.usuario_id_env
        left join tb_imagem im on im.id_imagem = u.imagem_id
        WHERE
            t.postagem_id = :id_post";

            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':id_post', $post_id);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            foreach ($row as $linha) {

                $result[] = (object)[
                    "id_comentario" => $linha['id_comentario'],
                    "usuario_id_env" => $linha['usuario_id_env'],
                    "dataInclusao" => $linha['dataInclusao'],
                    "texto" => $linha['texto'],
                    "nome" => $linha["nome"],
                    "imagem" => $linha["imagem"]  
                ];
            }
            return $result;
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function ComentarPost($post_id, $comentario, $usuario_id_origem, $usuario_id_dest){
        try {
            $query = "insert into tb_comentarios(postagem_id, usuario_id_env, usuario_id_rec, texto, dataInclusao) VALUES (:postagem_id, :usuario_id_origem, :usuario_id_dest, :texto, sysdate())";
            $stmt = $this->mysqlDB->prepare($query);
            $stmt->bindParam(':postagem_id', $post_id);
            $stmt->bindParam(':usuario_id_origem', $usuario_id_origem);
            $stmt->bindParam(':usuario_id_dest', $usuario_id_dest);
            $stmt->bindParam(':texto', $comentario);
            $stmt->execute();
        } catch (Exception $th) {
            throw $th;
        }
    }
    public function SetPostImage($nome, $image){
        $query = "insert into tb_imagem(titulo, imagem) VALUES (:titulo, :image)";
        $stmt = $this->mysqlDB->prepare($query);
        $stmt->bindParam(':titulo', $nome);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        $custId = $this->mysqlDB->lastInsertId();
        $stmt->closeCursor();
        return $custId;
    }
}
