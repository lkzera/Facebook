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
                        <textarea class="form-control" placeholder="Diga o que está pensando.."></textarea>
                        <ul class='list-inline post-actions'>
                            <li><a href="#"><span class="glyphicon glyphicon-camera">Foto</span></a></li>
                            <li class='pull-right'><a href="#" class='btn btn-primary btn-xs'>Post</a></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- New post aqui -->

    <div class="container-fluid posts-content">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- Todos os potst aqui abaixos -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="media mb-3">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3">
                                Usuário Teste
                                <div class="text-muted small">1 Minuto Atrás</div>
                            </div>
                        </div>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus finibus commodo bibendum. Vivamus laoreet blandit odio, vel finibus quam dictum ut.
                        </p>
                        <a href="post.php" class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('https://bootdey.com/img/Content/avatar/avatar3.png');"></a>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="media mb-3">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3">
                                Usuário Teste
                                <div class="text-muted small">1 Minuto Atrás</div>
                            </div>
                        </div>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus finibus commodo bibendum. Vivamus laoreet blandit odio, vel finibus quam dictum ut.
                        </p>
                        <a href="javascript:void(0)" class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('https://bootdey.com/img/Content/avatar/avatar3.png');"></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// layout do rodapé
include_once "layout_footer.php";
?>