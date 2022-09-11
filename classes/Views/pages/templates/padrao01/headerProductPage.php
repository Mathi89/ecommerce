<?php


if(isset($_GET['loggout'])){
  Painel::loggout();
}

    // $sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin_users` WHERE `id` = ? ");
    // $sql2->execute(array($_SESSION['id_user']));
    // $dado = $sql2->fetch();
    // $dados = $dado['imagem'];

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
        <link rel="stylesheet" href="<?= INCLUDE_CSS_T01?>headerpadraoProductPage.css">

        <title><?= $arr[0]['title'] ?> - Modest Harmonic</title>
    </head>
    <body>
    <p class="notfy sucessoJ"></p>
  <p class="notfy erroJ"></p>
  <p class="notfy atencaoJ"></p>


    <div class="container-cabecalho-phone">
          <div class="content-cabecalho">
              <div class="menu-phone ">
                <i id="go-back-for-page" class='icon-color bx bx-chevron-left'></i>
              </div>
              <div class="logo-phone">
                <img class="img-logo-phone" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/logo.png">
              </div>

              <div class="menu-phone ">
                <a href="<?= INCLUDE_PATH ?>cart"><i id="cart" class='icon-color bx bxs-cart'></i><span id="qtd-itens-header-cart"><?php if($qtdCart > 0){?>  <span class="circle-qtd-itens-cart"><?= $qtdCart ?></span>   <?php }?></span></a> 
                
              </div>
              <!-- <div class="search-phone">
                <i class='icon-btn-search bx bx-search-alt-2'></i>
              </div> -->
          </div>
      </div>
  <section class="section-all">

      <div class="section-pages">
          <div class="content-pages">
            <div class="pages-on-site-dynamic">
              