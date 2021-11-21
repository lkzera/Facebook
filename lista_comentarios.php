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

?>


<div class="col-md-10">

<button class="btn btn-secondary" type="button" id="btnVoltar">Voltar</button>

    <div class="container-fluid posts-content">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="media mb-3">
                                <div class="row">
                                    <div class="col-md-10">
                                        <img src="<?php echo $post->imagem ?>" class="d-block ui-w-40 rounded-circle" alt="">
                                    </div>
                                </div>

                                <div class="media-body ml-3">
                                    <?php echo $post->nome_usuario; ?>
                                    <div class="text-muted small"><?php echo $post->dataPostagem; ?></div>
                                </div>
                            </div>

                            <hr class="solid">

                            <div class="form-group">
                                <a name="descricao"><?php echo $post->texto; ?></a>
                            </div>
                            <a class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('https://bootdey.com/img/Content/avatar/avatar3.png');"></a>
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <div class="col-md-10">
                                    <input class="form-control" placeholder="Comentar" type="text" id="boxComentario">
                                </div>
                                <div class="col-md-2">
                                    <button id="btnComentar" type="button" class="btn btn-success" style="margin-left: 20px;">Enviar</button>
                                </div>
                            </div>
                            <ul class="comments-list p-0 m-1">
                                <?php
                                $listaComentarios = $_postRepository->GetComentarios($post_id);
                                foreach ($listaComentarios as $comentario) {
                                    echo '<li class="list-group-item">';
                                    echo '    <div class="row">';
                                    echo '        <div class="col-md-2 p-0 m-0">';
                                    echo '            <img src="' . $comentario->imagem . '" class="img-circle img-responsive img-user" alt="" />';
                                    echo '        </div>';
                                    echo '        <div class="col-md-10 p-0 m-0">';
                                    echo '            <div class="row">';
                                    echo '                <div class="col-md-8">';
                                    echo '                <h6>' . $comentario->nome . '</h6>';
                                    echo '                </div>';
                                    echo '                <div class="col-md-4">';
                                    echo '                <h6>' . $comentario->dataInclusao . '</h6>';
                                    echo '                </div>';
                                    echo '            </div>';
                                    echo '            <div class="comment-text">';
                                    echo                $comentario->texto;
                                    echo '            </div>';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '</li>';
                                }
                                ?>
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
        $(document).on('click', '#btnComentar', function() {
            var id_usuario = <?php echo $_SESSION["id_usuario"]; ?>;
            var post_id = <?php echo $post_id; ?>;
            var texto = $('#boxComentario').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'comentar.php',
                data: {
                    post_id: post_id,
                    id_usuario: id_usuario,
                    texto: texto
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $("#btnVoltar").on('click', function() {
                window.location.replace("index.php");

        });

    });
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>