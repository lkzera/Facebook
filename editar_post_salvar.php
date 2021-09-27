<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';


$inputTexto = $_POST["inputTexto"];
$post_id = $_POST["post_id"];
$result = ["success" => true];

if (!$post_id) {
    $result["success"] = false;
}

$_postRepository = new PostRepository();

$post = $_postRepository->findId($post_id);


if (!$post) {
    $result["success"] = false;
}

session_start();
if ($_SESSION["id_usuario"] !== $post->id_usuario) {
    $result["success"] = false;
}

$_postRepository->update(["texto" => $inputTexto], $post_id);

echo json_encode($result);

