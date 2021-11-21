<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

try {
session_start();

$post_text =  $_POST["post_text"];
$id_usuario = $_SESSION["id_usuario"];
$image = isset($_FILES['img']['tmp_name']) ? $_FILES['img']['tmp_name'] : null;
$imageSize =  isset($_FILES['img']['size']) ?  $_FILES['img']['size'] : null;


$_postRepository = new PostRepository();
$post = new Post(null,null,$post_text, $id_usuario);

$lastIdPost = $_postRepository->insert($post);

if ($image !== null && $imageSize > 0) {
    $nome_real= explode(".",$_FILES["img"]["name"])[0];
    $ext = explode(".",$_FILES["img"]["name"])[1];
    $path = "./uploads/$nome_real"."_".strtotime(date("Y-m-d H:i:s")).".".$ext;
    copy($image,$path);
    $lastId = $_postRepository->SetPostImage($nome_real, $path);
    $_postRepository->update(["id_imagem" => $lastId], $lastIdPost);
}

$response = array("success" => true);
	echo json_encode($response);

} catch (Exception $th) {
    echo $th;
}

?>