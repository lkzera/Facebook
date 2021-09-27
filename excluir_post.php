<?php
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

$post_id = $_POST["post_id"];

$_postRepository = new PostRepository();

$post = $_postRepository->findId($post_id);
$result = ["success" => false];

if($post){
    if($_postRepository->remove($post_id)){
       $result["success"] = true;
    }
}

echo json_encode($result);
