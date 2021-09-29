<?php

include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$_postRepository = new PostRepository();

header('Content-Type: application/json; charset=utf-8');
session_start();

echo json_encode($_postRepository->findPostsFriends($_SESSION["id_usuario"]));
