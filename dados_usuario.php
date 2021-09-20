<?php
$page_title = "";
include_once "layout_header.php";
include_once "layout_lateral.php";
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';


$user = new UserRepository();
$usuario = $user->findId($_SESSION["id_usuario"]);
?>

<div class="col-md-10 p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form id="dadosAlteraUsuario">
                    <div class="form-group">
                        <label for="inputDadosNome">Nome</label>
                        <input type="text" class="form-control" id="inputDadosNome" name="nome" value="<?php echo $usuario->getNome() ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDadosLogin">Login</label>
                        <input type="email" class="form-control" id="inputDadosLogin" name="login" value="<?php echo $usuario->getLogin() ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDadosEmail">Email</label>
                        <input type="text" class="form-control" id="inputDadosEmail" name="email" value="<?php echo $usuario->getEmail() ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDadosSenha">Senha</label>
                        <input type="password" class="form-control" id="inputDadosSenha" name="senha" value="">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="inputDadosdescricao" name="descricao" rows="3" ><?php echo $usuario->getDescricao()?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="Aniversario">Aniversário</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-outline">
                                    <input type="number" id="inputDadosDia" class="form-control" name="dia" placeholder="Dia" value="<?php echo Date('d',strtotime($usuario->getDataAniversario())) ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="inputDadosMes" class="form-control" name="mes" placeholder="Mês" value="<?php echo Date('m',strtotime($usuario->getDataAniversario())) ?>"/>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="inputDadosAno" class="form-control" name="ano" placeholder="Ano" value="<?php echo Date('Y',strtotime($usuario->getDataAniversario())) ?>" />
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="inputDadosPhoto">Selecionar uma foto</label>
                        <input type="file" class="form-control-file" id="inputDadosPhoto">
                    </div>

                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="button" id="btnSalvar">Salvar</button>
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
        
        $("#btnSalvar").on('click',function() {
            var id_usuario = <?php echo $_SESSION["id_usuario"] ?>;
            var nome = $('#inputDadosNome').val();
            var login = $('#inputDadosLogin').val();
            var email = $('#inputDadosEmail').val();
            var senha = $('#inputDadosSenha').val();
            var descricao = $('#inputDadosdescricao').val();
            var dataA = $('#inputDadosAno').val() + '/' + $('#inputDadosMes').val() + '/' + $('#inputDadosDia').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'salva_usuario.php',
                async: true,
                data: {
                    id_usuario: id_usuario,
                    nome: nome,
                    login: login,
                    email: email,
                    senha: senha,
                    descricao: descricao,
                    aniversario: dataA
                },
                success: function(response) {
                    
                },
                error: function(response) {
                   
                }
            })
        });

        $("#btnApagar").on('click', function() {
            var id_usuario = <?php echo $_SESSION["id_usuario"] ?>;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'deleta_usuario.php',
                async: true,
                data: {
                    id_usuario: id_usuario
                },
                success: function(response) {
                    alert(response.message);
                    window.location.replace("login.php");
                },
                error: function(response) {
                    alert(response.message);
                }
            })
        });

    });
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>