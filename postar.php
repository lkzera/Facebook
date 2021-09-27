<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

try {
session_start();

$post_text =  $_POST["post_text"];
$id_usuario = $_SESSION["id_usuario"];

$_postRepository = new PostRepository();
$post = new Post(null,null,$post_text, $id_usuario);

$_postRepository->insert($post);

$response = array("success" => true);
	echo json_encode($response);

} catch (Exception $th) {
    echo $th;
}

?>