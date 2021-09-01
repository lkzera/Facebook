<?php
include_once "./Controllers/Login/LoginController.php";

$controler = new LoginController();
$resultado = $controler->ValidaLogin('2', '3');
?>

<!DOCTYPE HTML>

<html lang=pt-br>

<head>
    <meta charset="UTF-8">
    <title>teste</title>
    <link rel="stylesheet" href="./Css/login.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <h1></h1>
    </header>

    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="content">
                    <div class="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>