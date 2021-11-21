<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

header('Content-Type: application/json; charset=utf-8');
$post_id = $_GET["post_id"];

$result = ["success" => true];

if (!$post_id) {
    $result["success"] = false;
}

$_postRepository = new PostRepository();


echo json_encode($_postRepository->GetComentarios($post_id));


