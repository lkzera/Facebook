<?php
include_once 'sessionControl.php';

if (is_session_started() === FALSE) {
            session_start();
        }

?>
<!DOCTYPE HTML>

<html lang=pt-br>

<head>
    <meta charset="UTF-8">
    <title>Facebook</title>
    <link rel="stylesheet" href="./Assets/Css/login.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <a class="navbar-brand texto" href="#">Facebook</a>
        </nav>
    </header>

    <section>
        <div class="container center">
            <form action="Logar.php" method="POST" role="form">
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar</button>
            </form>
        </div>
    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dadosForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="login" class="col-form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login"></input>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">email</label>
                            <input type="text" class="form-control" id="email" name="email"></input>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="col-form-label">senha</label>
                            <input type="password" class="form-control" id="senha" name="senha"></input>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                    <button type="button" class="btn btn-primary" id="btn_cadastrar">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever')
            var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body input')
        });

        $(document).ready(function() {
            $('#btn_cadastrar').click(function(e) {

                if ($('#nome').val() == '') {
                    e.preventDefault();
                    $('#dadosForm').addClass('was-validated');
                    return;
                }

                var dados = $('#dadosForm').serialize();

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'cadastrar.php',
                    async: true,
                    data: dados,
                    success: function(response) {
                        window.location.replace("login.php");
                    },
                    error: function(error) {
                        alert('deu ruim irmão');
                    }
                })
            });
        })
    </script>

</body>

</html>