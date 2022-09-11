
<?php


if(isset($_GET['loggout'])){
  Painel::loggout();
}
$sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin_users` WHERE `id` = ? ");
$sql2->execute(array($_SESSION['id_user']));
$dado = $sql2->fetch();
$dados = $dado['imagem'];
?>


<!DOCTYPE html>
  <html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="<?= INCLUDE_PATH?>classes/Views/imgsistem/icon.png" type="image/gif">

      <!--========== BOX ICONS ==========-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
      
      <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="<?= INCLUDE_PATH_FULL?>javascript/jquery.mask.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      
     
      

      <!--========== CSS ==========-->
      <link rel="stylesheet" href="<?= INCLUDE_PATH_FULL?>css/stylePainel.css">

      <title>Configurações - Digital Audience</title>
  </head>
  <body>
  <p class="notfy sucessoJ"></p>
  <p class="notfy erroJ"></p>
  <p class="notfy atencaoJ"></p>

  <div class="load">
       <div class="group_load">
            <img class="load_image" src="<?= INCLUDE_PATH ?>classes/Views/imgsistem/load.gif">
       </div>
   </div>
<div class="modal_tela_padrao">
    <div class="modal_box_padrao">
        <p id="close_modal_padrao" class="style_close_modal_padrao"><i class='bx bx-x' ></i></p>
        <div class="modal_contend_padrao">
            <div class="group_modal_padrao">
                <h2 class="title_modal_padrao">TITULO AQUI</h2>
            <hr>
            </div>
            <div class="group_modal_padrao">
                <p class="des_modal_padrao">Descrição da modal se tiver</p>
                <hr>
            </div>
            <div class="group_modal_padrao">
            
                <button class="btn_modal_padrao btn_yellow">Sim</button>
            </div>

        </div>
    </div>
</div>


      <!--========== SECTION ==========-->
      <section id="" class="section-painel mudarperfilsection">
          <!--========== HEADER ==========-->
          <header class="header">
          <img class="headerbanner" src="<?= INCLUDE_PATH?>classes/Views/imgsistem/background.png" alt="">
              <nav id="" class="nav">
                  <div class="painel-left">
                      <div class="content-titulo-painel">

                        <a href="<?= INCLUDE_PATH?>" ><img src="<?= INCLUDE_PATH?>classes/Views/imgsistem/logo.png" alt=""></a>
                      </div>
                      
                  </div>
                  <div class="client-right ">
                      <div id="btn-painel2" class="btn-painel btn-client-right">
                          <div class="btn-painel__burger mobile"></div>
                      </div>
                      <div class="client-rightAjax">
                      <h1 class="client-nome">
                          <?= $dado['nome'] ?>
                      </h1>
                      <div class="client-imagem">
                          <?php
                            if($dado['imagem'] == ''){?>
                        <img src="<?= INCLUDE_PATH?>classes/Views/imguser/user_none.png" alt="Perfil">
                            <?php }else{
                          ?>
                      <img src="<?= INCLUDE_PATH?>classes/Views/imguser/<?= $dado['imagem']?>" alt="Perfil">
                      <?php } ?>
                      </div>
                      </div>
                     
                  </div>
              </nav>
          </header>

          <div id="menu-painel" class="menu-painel2 ">
                <div class="titulo-dentro-do-painel">
                    <h1>Módulos central</h1>
                </div>
                <div class="content-titulo-de-categorias">
                    <div class="nomes-principais">
                        <a href="<?= INCLUDE_PATH_SETTING ?>" class="<?php selecionadoMenu('') ?> links-menu">
                            <div id="painel" class=" titulo-categoria">
                                <i class='<?php WordMenu('') ?> icon-menu bx bx-home-smile'></i>
                                <h1 class="<?php WordMenu('') ?> nome-painel">Geral</h1>
                            </div>
                        </a>
                        <a href="<?= INCLUDE_PATH?>settings/usuarios" <?php verificaPermissaoMenu(1)?> class="<?php selecionadoMenu('usuarios') ?> links-menu">
                            <div id="imobiliaria" class="titulo-categoria">
                            <i class='<?php WordMenu('usuarios') ?> icon-menu bx bxs-user'></i>
                                <h1 class="<?php WordMenu('usuarios') ?> nome-imobiliaria">Equipe</h1>
                            </div>
                        </a>
                        <a href="<?= INCLUDE_PATH_SETTING?>import_list" <?php verificaPermissaoMenu(1)?> class="<?php selecionadoMenu('import_list') ?> links-menu">
                            <div id="chaves" class="titulo-categoria">
                            <i class='<?php WordMenu('import_list') ?> icon-menu bx bx-list-ul'></i>
                                <h1 class="<?php WordMenu('import_list') ?> nome-chaves">Lista Prospecção</h1>
                            </div>
                        </a>
                        <a href="<?= INCLUDE_PATH_SETTING?>meu_fluxo" <?php verificaPermissaoMenu(1)?> class="<?php selecionadoMenu('meu_fluxo') ?> links-menu">
                            <div id="chaves" class="titulo-categoria">
                            <i class='<?php WordMenu('meu_fluxo') ?> icon-menu bx bxs-business'></i>
                                <h1 class="<?php WordMenu('meu_fluxo') ?> nome-chaves">Fluxo de Cadência</h1>
                            </div>
                        </a>
                        <a href="<?= INCLUDE_PATH_SETTING?>nichos_tarefas" <?php verificaPermissaoMenu(1)?> class="<?php selecionadoMenu('nichos_tarefas') ?> links-menu">
                            <div id="chaves" class="titulo-categoria">
                            <i class='<?php WordMenu('nichos_tarefas') ?> icon-menu bx bxs-business'></i>
                                <h1 class="<?php WordMenu('nichos_tarefas') ?> nome-chaves">Nichos e Tarefas</h1>
                            </div>
                        </a>
                        <a href="<?= INCLUDE_PATH_SETTING?>status" <?php verificaPermissaoMenu(1)?> class="<?php selecionadoMenu('status') ?> links-menu">
                            <div id="chaves" class="titulo-categoria">
                            <i class='<?php WordMenu('status') ?> icon-menu bx bxs-business'></i>
                                <h1 class="<?php WordMenu('status') ?> nome-chaves">Status Perdido</h1>
                            </div>
                        </a>
                        <a href="<?= INCLUDE_PATH_SETTING?>config_email" <?php verificaPermissaoMenu(1)?> class="<?php selecionadoMenu('config_email') ?> links-menu">
                            <div id="chaves" class="titulo-categoria">
                            <i class='<?php WordMenu('config_email') ?> icon-menu bx bxs-business'></i>
                                <h1 class="<?php WordMenu('config_email') ?> nome-chaves">Configuração Email</h1>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

          
        
          

          <div class="menu-usuario-right">
              <div class="content-usuario">
                  <div class="titulo-usuario">
                      <h1>Perfil de usuário</h1>
                      <div class="close-menu-usuario">
                          <i class='icon-close bx bx-x'></i>
                      </div>
                  </div>
                  <div class="content-usuario-info content-usuario-infoajax">
                      <div class="img-usuario-painel">
                      <?php
                            if($dado['imagem'] == ''){?>
                        <img src="<?= INCLUDE_PATH?>classes/Views/imguser/user_none.png" alt="Perfil">
                            <?php }else{
                          ?>
                      <img src="<?= INCLUDE_PATH?>classes/Views/imguser/<?= $dado['imagem']?>" alt="Perfil">
                      <?php } ?>
                      </div>
                      <div class="content-usuario-info-nomes-links">
                          <div class="usuario-nome">
                              <h1><?= $dado['nome'].' '.$dado['sobre_nome']  ?></h1>
                          </div>
                          <div class="usuario-email">
                              <i class='icon-email bx bxs-wrench'></i>
                              <h1><?= Painel::$cargos[$dado['cargo']] ?></h1>
                          </div>
                          <div class="btns-usuario">
                              <a href="<?= INCLUDE_PATH?>?loggout" class="btn-sair-usuario">
                                 Sair
                              </a>
                              <a href="<?= INCLUDE_PATH?>" class="btn-sair-usuario">
                                 Voltar
                              </a>
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>

    