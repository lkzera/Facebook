<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

try {

    $nome =  isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;
    $login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
    $senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
    $email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;

    $user = new UserRepository();
    $usuario = new Usuario(null, $login, $nome, $email, $senha, 'teste', null, null);

    $findUser = $user->find(["login" => $login, "email" => $email]);
    
    if ($findUser) {
        $response[] = ["error" => true, "message" => "Usuário já cadastrado no sistema"];
        echo json_encode($response);
        exit;
    }

    $user->insert($usuario);

    $response[] = array("success" => true);
    echo json_encode($response);
} catch (Exception $th) {
    $response[] = ["error" => true, "message" => $th];
    echo json_encode($response);
}
