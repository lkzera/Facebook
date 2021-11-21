<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';


$id_usuario = $_POST["id_usuario"];
$post_id = $_POST["post_id"];
$texto = $_POST["texto"];

$result = ["success" => true];

if (!$post_id) {
    $result["success"] = false;
}

$_postRepository = new PostRepository();

$post = $_postRepository->findId($post_id);


if (!$post) {
    $result["success"] = false;
}


$_postRepository->ComentarPost($post_id, $texto, $id_usuario, $post->id_usuario);

echo json_encode($result);

