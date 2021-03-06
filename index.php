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
                    <form enctype='multipart/form-data'>
                        <textarea class="form-control" id="postText" placeholder="Diga o que está pensando.."></textarea>
                        <ul class='list-inline post-actions'>
                            <li><label for="inputImagemPost">Selecionar uma foto</label>
                                <input type="file" class="form-control-file" id="inputImagemPost" name="image">
                            </li>
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
        loadDataPosts(null);

        // $(document).on('click', '.action-editar', function() {
        //     var id = $(this).closest('.dropdown-menu').data('id');
        //     console.log(id);
        // });

        $(document).on('click', '.pagclick', function() {
            var pag = $(this).text();
            loadDataPosts(pag);
        });

        $(document).on('click', '#comentarPostagem', function() {
            var id_usuario = <?php echo $_SESSION["id_usuario"]; ?>;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'lista_comentarios.php',
                data: {
                    post_id: $(this).data('id')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $(document).on('click', '#DescurtirPostagem', function() {
            var id_usuario = <?php echo $_SESSION["id_usuario"]; ?>;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'reacao.php',
                data: {
                    post_id: $(this).data('id'),
                    id_usuario: id_usuario,
                    tipo: 'D'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $(document).on('click', '#curtirPostagem', function() {
            var id_usuario = <?php echo $_SESSION["id_usuario"]; ?>;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'reacao.php',
                data: {
                    post_id: $(this).data('id'),
                    id_usuario: id_usuario,
                    tipo: 'C'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

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
            var img = $('#inputImagemPost')[0].files[0];
            var data = new FormData();
            data.append('post_text', texto);
            data.append('img', img);

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'postar.php',
                processData: false,
                contentType: false,
                cache: false,
                mimeType: 'multipart/form-data',
                data: data,
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    alert(response);
                }
            })
        });

    });

    function loadDataPosts(pag) {

        if (pag === null) {
            pag = 1;
        }

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'lista_postagens.php?page=' + pag,
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
        let pages = 0;
        var id_usuario = <?php echo $_SESSION["id_usuario"]; ?>;
        for (let item in posts) {
            pages = parseInt(posts[item].pages);
            dados += '<div class="row">';
            dados += '<div class="col-md-6 mx-auto">'
            dados += '<div class="card mb-4">'
            dados += '             <div class="card-body">'
            dados += '                 <div class="media mb-3">'
            dados += '                      <div class="row">'
            dados += '                      <div class="col-md-8">'
            if (posts[item].imagem_usuario){
                dados += `                     <img src="${posts[item].imagem_usuario}" class="d-block ui-w-40 rounded-circle" alt="">`
            }
            else{
                dados += `                     <img src="./uploads/363639-200.png" class="d-block ui-w-40 rounded-circle" alt="">`
            }
            
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
            if (posts[item].post_img){
               dados += `<hr class="solid">`; 
               dados += `                 <a href="#" class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('${posts[item].post_img}');"></a>`
            }
           
            dados += '             </div>'
            dados += '             <div class="card-footer">'
            dados += '                 <div class="row">'
            dados += `                     <div class="col-md-4">`
            dados += `                         <strong>${posts[item].curtidas}</strong> Curtidas</small>`
            dados += '                     </div>'
            dados += '                     <div class="col-md-8">'
            dados += `                         <strong>${posts[item].comentarios}</strong> Comentários</small>`
            dados += '                     </div>'
            dados += '                 </div>'
            dados += '                 <div class="row">'
            dados += '                     <div class="col-md-6 mx-auto">'

            if (posts[item].curtido == 0) {
                dados += `                         <a id="curtirPostagem" href="#" class="d-inline-block text-muted" data-id="${posts[item].id_postagem}">`
                dados += '                             <strong>Curtir</strong>'
                dados += '                         </a>'
            } else {
                dados += `                         <a id="DescurtirPostagem" href="#" class="d-inline-block text-muted" data-id="${posts[item].id_postagem}">`
                dados += '                             <strong>Descurtir</strong>'
                dados += '                         </a>'
            }
            dados += `                         <a  href="lista_comentarios.php?id=${posts[item].id_postagem}" class="d-inline-block text-muted ml-3">`
            dados += '                             <strong>Comentar</strong>'
            dados += '                         </a>'
            dados += '                     </div>'
            dados += '                 </div>'
            dados += '             </div>'
            dados += '         </div>'
            dados += '     </div>'
            dados += ' </div>'
        };
        if (pages != 0) {


            dados += '<nav aria-label="Page navigation example">'
            dados += '        <ul class="pagination">'


            for (var i = 1; i <= pages; i++) {
                dados += `            <li class="page-item"><a class="page-link pagclick" >${i}</a></li>`
            }


            dados += '        </ul>'
            dados += '</nav>'
        }
        return dados;
    }
</script>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>