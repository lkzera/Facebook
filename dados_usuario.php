<?php
$page_title = "";
include_once "layout_header.php";
include_once "layout_lateral.php";
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = new UserRepository();
$usuario = $user->findId($_SESSION["id_usuario"]);

?>

<div class="col-md-10 p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form>
                    <div class="form-group">
                        <label for="inputDadosNome">Nome</label>
                        <input type="text" class="form-control" id="inputDadosNome" value="<?php echo $usuario->getNome()?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDadosLogin">Login</label>
                        <input type="email" class="form-control" id="inputDadosLogin" value="<?php echo $usuario->getLogin()?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDadosEmail">Email</label>
                        <input type="text" class="form-control" id="inputDadosEmail" value="<?php echo $usuario->getEmail()?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDadosSenha">Senha</label>
                        <input type="password" class="form-control" id="inputDadosSenha" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="button" id="btnSalvar" >Salvar</button> 
                        <button class="btn btn-danger" type="button" id="btnApagar">Apagar Conta</button> 
                        <button class="btn btn-secondary" type="button">Voltar</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<script> 
 $(document).ready(function() {
    $("#btnSalvar").click(function(){
        <?php 
        $user->Update(array("nome" => $usuario->getNome()),$usuario->getNome());
        exit;
        ?>
    }); 
    $("#btnApagar").click(function(){
        <?php 
        $user->remove($usuario->getId_usuario());
        session_destroy(); 
        ?>
        window.location.replace("index.php");
    }); 
});
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>