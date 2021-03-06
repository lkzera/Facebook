<?php
include_once "layout_header.php";
include_once "layout_lateral.php";
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

$nome = $_GET["nome"];

$_userRepository = new UserRepository();
session_start();
$users = $_userRepository->SearchUsers($nome, $_SESSION["id_usuario"]);

?>



<div class="col-md-10 p-2">
    <div class="container-fluid">

        <?php
        echo '<div class="row">';
        echo '        <div class="col-md-2">';
        echo ' <button class="btn btn-secondary" type="button" id="btnVoltar">Voltar</button>';
        echo '</div>';
        echo '</div>';
        foreach ($users as $user) {
            echo '<div class="row">';
            echo '        <div class="col-md-8 mx-auto">';
            echo '            <div class="people-nearby">';
            echo '                <div class="nearby-user">';
            echo '                    <div class="row">';
            echo '                        <div class="col-md-2 col-sm-2">';
            echo '                            <img src="'.$user->imagem.'" alt="user" class="profile-photo-lg">';
            echo '                        </div>';
            echo '                        <div class="col-md-7 col-sm-7">';
            echo '                         <div id="idUsuarioIN" style="display:none;">';
            echo  $_SESSION["id_usuario"];
            echo '                         </div>';
            echo '                         <div id="amigoIdIn" style="display:none;">';
            echo  $user->id_usuario;
            echo '                         </div>';
            echo '                            <h5><a href="#" class="profile-link">' . $user->nome . '</a></h5>';
            echo '                            <p>' . $user->descricao . '</p>';
            echo '                            <p class="text-muted">500m away</p>';
            echo '                        </div>';
            if ($user->sol_pend == 0 && $user->amigo == 0) {
                echo '                        <div class="col-md-3 col-sm-3">';
                echo '                            <button class="btn btn-primary pull-right action-solicitar" >Solicitar</button>';
                echo '                        </div>';
            } elseif ($user->sol_pend == 1) {
                echo '                        <div class="col-md-3 col-sm-3">';
                echo '                            <button class="btn btn-secondary pull-right" disabled >Pendente</button>';
                echo '                        </div>';
            } elseif ($user->amigo == 1) {
                echo '                        <div class="col-md-3 col-sm-3">';
                echo '                            <button class="btn btn-success pull-right" disabled>Amigos</button>';
                echo '                            <button class="btn btn-danger pull-right action-undo">Desfazer</button>';
                echo '                        </div>';
            }

            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
        ?>

    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.action-solicitar', function() {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'solicitacoes.php',
                    async: true,
                    data: {
                        id_usuario: $('#idUsuarioIN').text(),
                        amigo_id: $('#amigoIdIn').text(),
                        op: 'INVITE'
                    },
                    success: function(response) {
                        alert("Solicita????o enviada");
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
            $(document).on('click', '.action-undo', function() {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'solicitacoes.php',
                    async: true,
                    data: {
                        id_usuario: $('#idUsuarioIN').text(),
                        amigo_id: $('#amigoIdIn').text(),
                        op: 'UNDO'
                    },
                    success: function(response) {
                        alert("Amizade exclu??da");
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            $("#btnVoltar").on('click', function() {
                window.location.replace("index.php");

            });
        });
    </script>


    <?php
    // layout do rodap??
    include_once "layout_footer.php";
