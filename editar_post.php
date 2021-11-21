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
                                        <img src="<?php echo $post->imagem; ?>" class="d-block ui-w-40 rounded-circle" alt="">
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
                            <a class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('<?php echo $post->post_img; ?>'); margin-top:20px; border-style: groove;"></a>
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