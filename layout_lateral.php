<?php
$name = substr($_SESSION["nome_usuario"], 0, 10);
?>
<div class="container-fluid">
  <div class="row flex-nowrap">
    <div class="col-auto col-md-2 col-xl-2 px-sm-2 px-0 sidebar">
      <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none">
          <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
          <span class="p-1"><?php echo $name; ?></span>
        </a>
        <a href="lista_solicitacoes.php" class="d-flex align-items-center text-white text-decoration-none">
          <span class="p-1">Solicitações</span>
        </a>
      </div>
    </div>