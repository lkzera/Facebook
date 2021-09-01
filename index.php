<?php
include_once "./Controllers/Login/LoginController.php";
$controler = new LoginController();
$resultado = $controler->ValidaLogin('2','3');
?>

<!DOCTYPE HTML>

<html lang=pt-br>

<head>
    <meta charset="UTF-8">
    <title>teste</title>
    <link rel="stylesheet" type="text/css" href="libs/css/custom2.css">

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- our custom CSS -->
    <link rel="stylesheet" href="libs/css/custom.css" />

</head>

<body>
    <header>
        <h1><?php echo $resultado[0]; ?></h1>
    </header>
</body>

</html>