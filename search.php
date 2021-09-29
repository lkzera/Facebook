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
    foreach ($users as $user) {
        echo '<div class="row">';
        echo '        <div class="col-md-8 mx-auto">';
        echo '            <div class="people-nearby">';
        echo '                <div class="nearby-user">';
        echo '                    <div class="row">';
        echo '                        <div class="col-md-2 col-sm-2">';
        echo '                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" class="profile-photo-lg">';
        echo '                        </div>';
        echo '                        <div class="col-md-7 col-sm-7">';
        echo '                            <h5><a href="#" class="profile-link">'.$user->nome.'</a></h5>';
        echo '                            <p>'.$user->descricao.'</p>';
        echo '                            <p class="text-muted">500m away</p>';
        echo '                        </div>';
        if($user->sol_pend == 0 && $user->amigo == 0 ){
            echo '                        <div class="col-md-3 col-sm-3">';
            echo '                            <button class="btn btn-primary pull-right" >Solicitar</button>';
            echo '                        </div>';
        }elseif ($user->sol_pend == 1) {
            echo '                        <div class="col-md-3 col-sm-3">';
            echo '                            <button class="btn btn-secondary pull-right" disabled >Pendente</button>';
            echo '                        </div>';
        }
        elseif ($user->amigo == 1) {
            echo '                        <div class="col-md-3 col-sm-3">';
            echo '                            <button class="btn btn-success pull-right" disabled >Amigos</button>';
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


<?php
// layout do rodapé
include_once "layout_footer.php";
