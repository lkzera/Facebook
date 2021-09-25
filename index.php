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

    <div class="container-fluid posts-content" id="postagens">
        
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

    function loadDataPosts(){

        $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'lista_postagens.php',
                async: true,
                success: function(response) {
                 $('#postagens').html(parsePosts(response));
                },
                error: function(response) {
                    alert(response.message);
                }
            });
    }

    function parsePosts(posts){
        let dados = '';

        //Object.keys(posts).map(function(key, index) {
        for( let [key, value] of Object.entries(posts)){

       dados += '<div class="row">';
       dados += '<div class="col-md-6 mx-auto">'
       dados += '<div class="card mb-4">'
 dados += '             <div class="card-body">'
 dados += '                 <div class="media mb-3">'
 dados += '                     <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="d-block ui-w-40 rounded-circle" alt="">'
 dados += '                     <div class="media-body ml-3">'
 dados += '                         Usuário Teste'
 dados += '                         <div class="text-muted small">1 Minuto Atrás</div>'
 dados += '                     </div>'
 dados += '                 </div>'

 dados += '                 <p>'
 dados += value + " " + key;
 dados += '                 </p>'
 dados += `                 <a href="post.php" class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('https://bootdey.com/img/Content/avatar/avatar3.png');"></a>`
 dados += '             </div>'
 dados += '             <div class="card-footer">'
 dados += '                 <div class="row">'
 dados += '                     <div class="col-md-4">'
 dados += '                         <strong>123</strong> Curtidas</small>'
 dados += '                     </div>'
 dados += '                     <div class="col-md-8">'
 dados += '                         <strong>12</strong> Comentários</small>'
 dados += '                         <strong>1</strong> Compartilhamentos</small>'
 dados += '                     </div>'
 dados += '                 </div>'
 dados += '                 <div class="row">'
 dados += '                     <div class="col-md-6 mx-auto">'
 dados += '                         <a href="javascript:void(0)" class="d-inline-block text-muted">'
 dados += '                             <strong>Curtir</strong>'
 dados += '                         </a>'
 dados += '                         <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">'
 dados += '                             <strong>Comentar</strong>'
 dados += '                         </a>'
 dados += '                         <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">'
 dados += '                             <strong>Compartilhar</strong>'
 dados += '                         </a>'
 dados += '                     </div>'
 dados += '                 </div>'
 dados += '             </div>'
 dados += '         </div>'
 dados += '     </div>'
 dados += ' </div>'
        };

       return dados;
    }
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>