<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

$nome = isset($_GET["nome"]) ? $_GET["nome"] : null;
$email = isset($_GET["email"]) ? $_GET["email"] : null;
$login = isset($_GET["login"]) ? $_GET["login"] : null;

$_userRepository = new UserRepository();

$_resul = $_userRepository->SearchUserAndFriends($nome,$login,$email);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($_resul);