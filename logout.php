<?php

include_once "sessionControl.php";
    session_start();
    if(isset($_SESSION["nome_usuario"])) {
        session_destroy();
        header("location: index.php");
        exit();
    } 
?>


		