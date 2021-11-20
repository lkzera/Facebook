<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

$usuarioId = $_POST["id_usuario"];
$tipo = $_POST["tipo"];
$postId = $_POST["post_id"];

$_postRepository = new PostRepository();

if($tipo == "C"){
    $_postRepository->CurtirPost($usuarioId,$postId);
    $result = ["success" => true];
    echo json_encode($result);
    
}

if($tipo == "D"){
    $_postRepository->DescurtirPost($usuarioId,$postId);
    $result = ["success" => true];
    echo json_encode($result);
}


