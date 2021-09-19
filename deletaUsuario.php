<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id_usuario = $_POST["id_usuario"];

$user = new UserRepository();
$usuario = $user->findId($_SESSION["id_usuario"]);

?>