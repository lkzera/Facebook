<?php
$page_title = "";
include_once "layout_header.php";
include_once "layout_lateral.php";
?>

<div class="col-md-10 p-2">

    <!-- New post aqui -->
    <div class="container-fluid bootstrap snippets bootdey m-10">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-xs-12 mx-auto">
                <div class="well well-sm well-social-post">
                    <form>
                        <textarea class="form-control" id="postText" placeholder="Diga o que está pensando.."></textarea>
                        <ul class='list-inline post-actions'>
                            <li><a href="#"><span class="glyphicon glyphicon-camera">Foto</span></a></li>
                            <button class="btn btn-primary" type="button" id="btnPostagem">Postar</button>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- New post aqui -->

    <div class="container-fluid posts-content">

    </div>
</div>

<script>
    $(document).ready(function() {
        loadDataPosts();

        $("#btnPostagem").on('click', function() {
            var texto = $('#postText').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'postar.php',
                async: true,
                data: {
                    post_text: texto
                },
                success: function(response) {
                    alert(response.message);
                    window.location.replace("index.php");
                },
                error: function(response) {
                    alert(response.message);
                }
            })
        });
    });

    function loadDataPosts() {
        
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: 'lista_postagens.php',
            async: true,
            success: function(response) {
               console.log('ola');
            },
            error: function(response) {
                alert(response.message);
            }
        });

    }
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>