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

        // $(document).on('click', '.action-editar', function() {
        //     var id = $(this).closest('.dropdown-menu').data('id');
        //     console.log(id);
        // });
        $(document).on('click', '.action-excluir', function() {
            if (confirm("Deseja realmente deletar o post?")) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'excluir_post.php',
                    async: true,
                    data: {
                        post_id: $(this).closest('.dropdown-menu').data('id')
                    },
                    success: function(response) {
                        alert("Post excluído com sucesso!!");
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }

        });

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
                    location.reload();
                },
                error: function(response) {
                    alert(response);
                }
            })
        });

    });

    function loadDataPosts() {
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

    function parsePosts(posts) {
        let dados = '';
        var id_usuario = <?php echo $_SESSION["id_usuario"]; ?>;
        for (let item in posts) {
            dados += '<div class="row">';
            dados += '<div class="col-md-6 mx-auto">'
            dados += '<div class="card mb-4">'
            dados += '             <div class="card-body">'
            dados += '                 <div class="media mb-3">'
            dados += '                      <div class="row">'
            dados += '                      <div class="col-md-8">'
            dados += '                     <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="d-block ui-w-40 rounded-circle" alt="">'
            dados += '                      </div>'
            if (id_usuario == posts[item].id_usuario) {
                // dados += '                      <div class="col-md-1">'
                // dados += `                        <button id="${posts[item].id_postagem}" class="teste01 btn btn-danger">X</button>`
                // dados += '                      </div>'
                dados += '                      <div class="col-md-2 offset-md-2">'
                dados += `<div class="dropdown">`
                dados += `                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">`
                dados += `                    ...`
                dados += `                </button>`
                dados += `                <ul class="dropdown-menu" data-id="${posts[item].id_postagem}" aria-labelledby="dropdownMenuButton1">`
                dados += `                    <li><a class="dropdown-item action-editar" href="editar_post.php?id=${posts[item].id_postagem}">Editar</a></li>`
                dados += `                    <li><a class="dropdown-item action-excluir">Excluir</a></li>`
                dados += `                </ul>`
                dados += `</div>`
                dados += '                      </div>'
            }
            dados += '                      </div>'
            dados += '                     <div class="media-body ml-3">'
            dados += `                        ${posts[item].nome_usuario}`
            dados += `                         <div class="text-muted small">${posts[item].dataPostagem}</div>`
            dados += '                     </div>'
            dados += '                     <div id="idPostagem" style="display:none;">'
            dados += `                     ${posts[item].id_postagem}`
            dados += '                     </div>'
            dados += '                     <div id="idUsuario" style="display:none;">'
            dados += `                     ${posts[item].id_usuario}`
            dados += '                     </div>'
            dados += '                 </div>'

            dados += '                 <p>'
            dados += `${posts[item].texto}`;
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