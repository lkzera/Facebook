<?php
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

$id_usuario = $_POST["id_usuario"];
$nome = $_POST["nome"];
$login = $_POST["login"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$descricao = $_POST["descricao"];
$aniversario = $_POST["aniversario"];

if (!is_null($id_usuario)) {
    $user = new UserRepository();
    $usuario = $user->findId($id_usuario);
    $params = [];

    if ($usuario->getNome() !== $nome)
        $params += ["nome" => $nome];

    if ($usuario->getLogin() !== $login)
        $params += ["login" => $login];

    if ($usuario->getEmail() !== $email)
        $params += ["email" => $email];

    if (strlen($senha) > 0 && $usuario->getSenha() !== md5($senha))
        $params += ["senha" => $senha];

    if ($usuario->getDataAniversario() !== $aniversario) {
        $aniversario = new DateTime($aniversario);
        $aniversario = date_format($aniversario, "Y-m-d");
        $params += ["dataAniversario" => $aniversario];
    }
    if ($usuario->getDescricao() !== $descricao)
        $params += ["descricao" => $descricao];

    if (count($params) > 0) {
        $erro = !$user->update($params, $id_usuario);

        if (!$erro) {
            session_start();
            $_SESSION["nome_usuario"] = $nome;
            $response = ['success' => true, 'message' => 'Usuário alterado com sucesso.'];
            echo json_encode($response);
            exit;
        }
    }   
    $response = ['error' => true, 'message' => 'Não foi possível alterar o usuário'];
    echo json_encode($response);
    exit;
}
