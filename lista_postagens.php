<?php

include_once './Db/Post/PostRepository.php';
include_once './Models/Post.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_postRepository = new PostRepository();
$output = "";
$posts[] = $_postRepository->findAll();


    foreach ($posts as $post){
       echo ` <div class="row">`;
       echo `     <div class="col-md-6 mx-auto">`;
      
       echo `         <div class="card mb-4">`;
       echo `             <div class="card-body">`;
       echo `                 <div class="media mb-3">`;
       echo `                     <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="d-block ui-w-40 rounded-circle" alt="">`;
       echo `                     <div class="media-body ml-3">`;
       echo `                         Usuário Teste`;
       echo `                         <div class="text-muted small">1 Minuto Atrás</div>`;
       echo `                     </div>`;
       echo `                 </div>`;
       echo `                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus finibus commodo bibendum. Vivamus laoreet blandit odio, vel finibus quam dictum ut.</p>`;
       echo `                 <a href="post.php" class="ui-rect ui-bg-cover ui-rect-image" style="background-image: url('https://bootdey.com/img/Content/avatar/avatar3.png');"></a>`;
       echo `             </div>`;
       echo `             <div class="card-footer">`;
       echo `                 <div class="row">`;
       echo `                     <div class="col-md-4">`;
       echo `                         <strong>123</strong> Curtidas</small>`;
       echo `                     </div>`;
       echo `                     <div class="col-md-8">`;
       echo `                         <strong>12</strong> Comentários</small>`;
       echo `                         <strong>1</strong> Compartilhamentos</small>`;
       echo `                     </div>`;
       echo `                 </div>`;
       echo `                 <div class="row">`;
       echo `                     <div class="col-md-6 mx-auto">`;
       echo `                         <a href="javascript:void(0)" class="d-inline-block text-muted">`;
       echo `                             <strong>Curtir</strong>`;
       echo `                         </a>`;
       echo `                         <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">`;
       echo `                             <strong>Comentar</strong>`;
       echo `                         </a>`;
       echo `                         <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">`;
       echo `                             <strong>Compartilhar</strong>`;
       echo `                         </a>`;
       echo `                     </div>`;
       echo `                 </div>`;
       echo `             </div>`;
       echo `         </div>`;
       echo `     </div>`;
       echo ` </div>`;


    }
?>