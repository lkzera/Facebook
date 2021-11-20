<?php
include_once './Db/User/UserRepository.php';
$name = substr($_SESSION["nome_usuario"], 0, 10);
$_userRepository = new UserRepository();

$imagemPerfil = $_userRepository->getUserImage($_SESSION["id_usuario"]);

if ($imagemPerfil === null){
  $imagemPerfil = "./uploads/363639-200.png";
}

?>
<div class="container-fluid">
  <div class="row flex-nowrap">
    <div class="col-auto col-md-2 col-xl-2 px-sm-2 px-0 sidebar">
      <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none">
        <?php 
        echo '<img src="'.$imagemPerfil.'" alt="hugenerd" width="30" height="30" class="rounded-circle">'
        ?> 
          <span class="p-1"><?php echo $name; ?></span>
        </a>
      </div>
    </div>