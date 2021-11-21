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
                            <a class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('<?php echo $post->post_img; ?>');"></a>
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
                            <div id="listComentarios">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        loadPost();

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
                    $.ajax({
                        type: 'GET',
                        dataType: 'JSON',
                        url: 'comentarios.php',
                        data: {
                            post_id: post_id
                        },
                        success: function(response) {
                            $('#listComentarios').html(parseComentarios(response));
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $("#btnVoltar").on('click', function() {
            window.location.replace("index.php");

        });

        function loadPost() {
            var post_id = <?php echo $post_id; ?>;
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: 'comentarios.php',
                data: {
                    post_id: post_id
                },
                success: function(response) {
                    $('#listComentarios').html(parseComentarios(response));
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function parseComentarios(comentarios) {
            let dados = '';
            dados += '<ul class="comments-list p-0 m-1">';
            for (let coment in comentarios) {
                dados += '<li class="list-group-item" style="margin-top:10px;">';
                dados += '    <div class="row">';
                dados += '        <div class="col-md-2 p-0 m-0">';
                dados += `            <img src="${comentarios[coment].imagem}" class="img-circle img-responsive img-user" alt="" />`;
                dados += '        </div>';
                dados += '        <div class="col-md-10 p-0 m-0">';
                dados += '            <div class="row">';
                dados += '                <div class="col-md-8">';
                dados += `                <h6>${comentarios[coment].nome}</h6>`;
                dados += '                </div>';
                dados += '                <div class="col-md-4">';
                dados += `                <h6>${comentarios[coment].dataInclusao}</h6>`;
                dados += '                </div>';
                dados += '            </div>';
                dados += '            <div class="comment-text">';
                dados += comentarios[coment].texto;
                dados += '            </div>';
                dados += '        </div>';
                dados += '    </div>';
                dados += '</li>';

            }
            dados += '</ul>';
            return dados;
        }

    });
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>