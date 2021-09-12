<!DOCTYPE HTML>

<html lang=pt-br>

<head>
    <meta charset="UTF-8">
    <title>Facebook</title>
    <link rel="stylesheet" href="./Assets/Css/header.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <?php
        include_once "sessionControl.php";

        if (is_session_started() === FALSE) {
            session_start();
        }

        if (isset($_SESSION["nome_usuario"])) {
            $name = substr($_SESSION["nome_usuario"], 0, 10);
        } else {
            Header("Location: login.php");
            exit;
        }
        ?>

        <nav class="navbar navbar-expand-lg navbar-default">
            <div class="container-fluid">
                <form class="d-flex">
                    <a class="navbar-brand">Facebook</a>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
            <div class="collapse navbar-collapse navbar-right">
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item">
                        <h6 class="fs-6 text-center"><?php echo $name; ?></h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header>