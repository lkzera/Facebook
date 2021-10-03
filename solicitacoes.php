<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';


$amigo_id = $_POST["amigo_id"];
$id_usuarioPost = $_POST["id_usuario"];
$op = $_POST["op"];
session_start();
$id_usuario = $_SESSION["id_usuario"];
$_userRepository = new UserRepository();

if($op == "ACCINVITE"){
    $_userRepository->AcceptInvite($amigo_id,$id_usuarioPost);
    $result = ["success" => true];
    echo json_encode($result);
    
}

if($op == "INVITE"){
    $_userRepository->InviteUser($id_usuarioPost,$amigo_id);
    $result = ["success" => true];
    echo json_encode($result);
}

if($op == "UNDO"){
    $_userRepository->UndoUser($id_usuarioPost,$amigo_id);
    $result = ["success" => true];
    echo json_encode($result);
}


