<?php
$page_title = "";
include_once "layout_header.php";
include_once "layout_lateral.php";
?>

<div class="col-md-10">

    <div class="container-fluid posts-content">
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
            </div>
        </div>
    </div>

</div>
<?php
// layout do rodapé
include_once "layout_footer.php";
?>