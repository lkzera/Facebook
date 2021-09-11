<?php 

include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

session_start();
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE; 
$senha = isset($_POST["senha"]) ? addslashes(trim($_POST["senha"])) : FALSE; 

if(!$login || !$senha) 
{ 
    echo "login = " . $login . " / senha = " . $senha . "<br>";
    echo "Você deve digitar sua senha e login!<br>"; 
    echo "<a href='login.php'>Efetuar Login</a>";
    exit; 
}  

$user = new UserRepository();
$usuario = $user->find($login);
var_dump($usuario);

$problemas = FALSE;
if($usuario) {
    // Agora verifica a senha 
    if(!strcmp($senha, $usuario->getSenha())) 
    { 
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
        $_SESSION["id_usuario"]= $usuario->getId_usuario(); 
        $_SESSION["nome_usuario"] = stripslashes($usuario->getNome()); 
        header("Location: index.php");
        exit; 
    } else {
        $problemas = TRUE; 
    }
} else {
    $problemas = TRUE; 
}

if($problemas==TRUE) {
    header("Location: login.php"); 
    exit; 
}
?>
