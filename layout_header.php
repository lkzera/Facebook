<!DOCTYPE HTML>

<html lang=pt-br>

<head>
    <meta charset="UTF-8">
    <title>Facebook</title>
    <link rel="stylesheet" href="./Assets/Css/header.css" type="text/css" />
    <link rel="stylesheet"href="./Assets/Css/newPost.css" type="text/css" />
    <link rel="stylesheet"href="./Assets/Css/listUsers.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <?php
        include_once "sessionControl.php";
        include_once './Db/User/UserRepository.php';
        include_once './Models/Usuario.php';

        if (is_session_started() === FALSE) {
            session_start();
        }

        if (isset($_SESSION["nome_usuario"])) {
            $_userRepository = new UserRepository();
            $name = substr($_SESSION["nome_usuario"], 0, 10);
            $idUser = $_SESSION["id_usuario"];
            $total = $_userRepository->GetNumberSolPed($idUser);
        } else {
            Header("Location: login.php");
            exit;
        }
        ?>

        <nav id="navPri" class="navbar navbar-expand-lg navbar-default">
            <div class="container-fluid">
                <form class="d-flex" method="GET" action="search.php">
                    <a class="navbar-brand">Facebook</a>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="nome">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
            <div class="collapse navbar-collapse navbar-right">
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" style="color:red;" href="lista_solicitacoes.php"><?php echo $total; ?></a>
                    </li>
                    <li class="nav-item">
                        <a id="modalUser" class="nav-link" style="color:white;" href="dados_usuario.php"><?php echo $name; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:white;" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    