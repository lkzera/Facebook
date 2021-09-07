<?php
include_once "./Controllers/Login/LoginController.php";

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
        <nav class="navbar navbar-default">
            <a class="navbar-brand texto" href="#">Facebook</a>
        </nav>
    </header>

    <section>
        <div class="container center">
            <form action="executa_login.php" method="POST" role="form">
                <legend>Facebook - Login</legend>
                <div class="form-group">
                    <label for="login">Login</label>
                    <br>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Informe o Login">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe a senha">
                </div>
                <br>

                <button type="submit" class="btn btn-primary">OK</button>
            </form>
        </div>
    </section>

</body>

</html>