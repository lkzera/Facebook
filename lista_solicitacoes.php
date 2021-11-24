<?php
include_once "layout_header.php";
include_once "layout_lateral.php";
include_once './Db/User/UserRepository.php';
include_once './Models/Usuario.php';

$_userRepository = new UserRepository();
session_start();
$users = $_userRepository->GetFriendsPend($_SESSION["id_usuario"]);

?>

<div class="col-md-10 p-2">
    <div class="container-fluid">
        <?php
        echo '<div class="row">';
        echo '        <div class="col-md-2">';
        echo ' <button class="btn btn-secondary" type="button" id="btnVoltar">Voltar</button>';
        echo '</div>';
        echo '</div>';
        if ($users){
        foreach ($users as $user) {
            echo '<div class="row">';
            echo '        <div class="col-md-8 mx-auto">';
            echo '            <div class="people-nearby">';
            echo '                <div class="nearby-user">';
            echo '                    <div class="row">';
            echo '                        <div class="col-md-2 col-sm-2">';
           if ($user->imagem == null){
            echo '                           <img src="./uploads/363639-200.png" alt="user" class="profile-photo-lg">';
           }
           else{
            echo '                           <img src="'.$user->imagem.'" alt="user" class="profile-photo-lg">';
           }
            echo '                        </div>';
            echo '                        <div class="col-md-7 col-sm-7">';
            echo '                         <div id="idUsuarioIN" style="display:none;">';
            echo  $user->id_usuario;
            echo '                         </div>';
            echo '                         <div id="amigoIdIn" style="display:none;">';
            echo  $user->amigo_id;
            echo '                         </div>';
            echo '                            <h5><a href="#" class="profile-link">' . $user->nome . '</a></h5>';
            echo '                            <p>' . $user->descricao . '</p>';
            echo '                            <p class="text-muted hidden">500m away</p>';
            echo '                        </div>';
            echo '                        <div class="col-md-3 col-sm-3">';
            echo '                            <button class="btn btn-warning pull-right action-accept">Aceitar</button>';
            echo '                        </div>';
            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '</div>';
        }
    }else{
        echo '        <div class="col-md-8 mx-auto">';
        echo 'Não existem solicitações pendentes';
        echo '</div>';
    }
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {
                $(document).on('click', '.action-accept', function() {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: 'solicitacoes.php',
                        async: true,
                        data: {
                            id_usuario: $('#idUsuarioIN').text(),
                            amigo_id: $('#amigoIdIn').text(),
                            op: 'ACCINVITE'
                        },
                        success: function(response) {
                            alert("Post excluído com sucesso!!");
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });

        $("#btnVoltar").on('click', function(){
          window.location.replace("index.php");   

        });
    });
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
