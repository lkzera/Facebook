<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

$id_usuario = $_POST["id_usuario"];

$user = new UserRepository();
$usuario = $user->findId($id_usuario);
$response = '';

    if(is_null($usuario->getId_usuario())){
        $response = array('error' => true, 'message' => 'Não foi possível deletar o usuário.');
        echo json_encode($response);
        exit;
    }
    else{
        $user->remove($usuario->getId_usuario());
        session_destroy();
        $response = array('success' => true, 'message' => 'Usuário deletado com sucesso.');
        echo json_encode($response);
    }

?>