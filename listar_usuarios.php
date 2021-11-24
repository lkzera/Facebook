<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

$nome = $_GET["nome"];

$_userRepository = new UserRepository();

$_resul = $_userRepository->SearchUserAndFriends("lucas",null,null);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($_resul);