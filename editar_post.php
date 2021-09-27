<?php
include_once "layout_header.php";
include_once "layout_lateral.php";
include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';


$post_id = $_GET["id"];

if (!$post_id) {
    header('location: index.php');
}

$_postRepository = new PostRepository();

$post = $_postRepository->findId($post_id);


if (!$post) {
    header('location: index.php');
}

session_start();
if ($_SESSION["id_usuario"] !== $post->id_usuario) {
    header('location: index.php');
}


?>

<div class="col-md-10">

    <div class="container-fluid posts-content">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="media mb-3">
                                <div class="row">
                                    <div class="col-md-10">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="d-block ui-w-40 rounded-circle" alt="">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-success" type="button" id="btnSalvar">Salvar</button>
                                    </div>
                                </div>

                                <div class="media-body ml-3">
                                    <?php echo $post->nome_usuario; ?>
                                    <div class="text-muted small"><?php echo $post->dataPostagem; ?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="inputTexto" name="descricao" rows="3"><?php echo $post->texto; ?></textarea>
                            </div>
                            <a class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('https://bootdey.com/img/Content/avatar/avatar3.png');"></a>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>123</strong> Curtidas</small>
                                </div>
                                <div class="col-md-8">
                                    <strong>12</strong> Comentários</small>
                                    <strong>1</strong> Compartilhamentos</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <a href="javascript:void(0)" class="d-inline-block text-muted">
                                        <strong>Curtir</strong>
                                    </a>
                                    <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                                        <strong>Comentar</strong>
                                    </a>
                                    <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                                        <strong>Compartilhar</strong>
                                    </a>
                                </div>
                            </div>
                            <div class="input-group">
                                <input class="form-control" placeholder="Add a comment" type="text">
                                <span class="input-group-addon">
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                </span>
                            </div>
                            <ul class="comments-list">
                                <li class="comment">
                                    <a class="pull-left" href="#">
                                        <img class="avatar" src="https://bootdey.com/img/Content/user_1.jpg" alt="avatar">
                                    </a>
                                    <div class="comment-body">
                                        <div class="comment-heading">
                                            <h4 class="user">Usuário 1</h4>
                                            <h5 class="time">5 minutos atrás</h5>
                                        </div>
                                        <p>COMENTÁRIOOOOOOO</p>
                                    </div>
                                    <ul class="comments-list">
                                        <li class="comment">
                                            <a class="pull-left" href="#">
                                                <img class="avatar" src="https://bootdey.com/img/Content/user_3.jpg" alt="avatar">
                                            </a>
                                            <div class="comment-body">
                                                <div class="comment-heading">
                                                    <h4 class="user">Usuário 2</h4>
                                                    <h5 class="time">3 minutos atrás</h5>
                                                </div>
                                                <p>Comentário</p>
                                            </div>
                                        </li>
                                        <li class="comment">
                                            <a class="pull-left" href="#">
                                                <img class="avatar" src="https://bootdey.com/img/Content/user_2.jpg" alt="avatar">
                                            </a>
                                            <div class="comment-body">
                                                <div class="comment-heading">
                                                    <h4 class="user">Usuário 3</h4>
                                                    <h5 class="time">3 minutos atrás</h5>
                                                </div>
                                                <p>Comentáriooo</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#btnSalvar').on('click', function() {
            var formData = {
                inputTexto: $('#inputTexto').val(),
                post_id: <?php echo $post_id; ?>
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'editar_post_salvar.php',
                async: true,
                data: formData,
                success: function(response) {
                    window.location.replace("index.php");
                },
                error: function(response) {
                    alert(response.message);
                }
            })

        });
    });
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>