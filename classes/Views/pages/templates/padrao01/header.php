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
        <link rel="stylesheet" href="<?= INCLUDE_CSS_T01?>headerpadrao.css">

        <?= $arr['tags'] ?>
    </head>
    <body>
    <p class="notfy sucessoJ"></p>
  <p class="notfy erroJ"></p>
  <p class="notfy atencaoJ"></p>

<!-- HEADER MOBILE -->
    <div class="container-cabecalho-phone">
          <div class="content-cabecalho">
              <div class="menu-phone">
                <i class='bx bxs-dashboard'></i>
              </div>
              <div class="logo-phone">
                <img class="img-logo-phone" src="<?= ($empresa['logo'] != "")? INCLUDE_PATH_VIEWS_PAINEL.'imgsistem/'.$empresa['logo'] : INCLUDE_PATH_VIEWS_PAINEL.'imgsistem/logo.png' ?>">
              </div>
              <div class="search-phone">
                <i class='icon-btn-search bx bx-search-alt-2'></i>
              </div>
          </div>
      </div>
<!-- FIM HEADER MOBILE -->
<header class="header-desktop padding-onsite">
  <div class="content-cabecalho-desktop">
    <div class="logo-header-space">
      <img class="logo-img-header" src="<?= ($empresa['logo'] != "")? INCLUDE_PATH_VIEWS_PAINEL.'imgsistem/'.$empresa['logo'] : INCLUDE_PATH_VIEWS_PAINEL.'imgsistem/logo.png' ?>">
    </div>
    <ul class="menus-desktop">
            
            <li class="list ">
                 <a href="<?= INCLUDE_PATH ?>">
                     <span>Home</span>
                 </a>
             </li>

             <li class="list ">
                 <a href="<?= INCLUDE_PATH ?>cart">
                     <span class="carrinho-corpo" >Carrinho<span id="qtd-itens-header-cart"><?php if($qtdCart > 0){?>  <span class="circle-qtd-itens-cart"><?= $qtdCart ?></span>   <?php } ?> </span></span>
                 </a>
             </li>

             <li class="list ">
                 <a href="<?= INCLUDE_PATH ?>">
                     <span class="menu-minhaconta">Minha conta <i class='icon bx bxs-user-circle'></i></span>
                 </a>
             </li>
    </ul>
  </div>
</header>


  <section class="section-all">

      <div class="section-pages">
          <div class="content-pages">
            <div class="pages-on-site-dynamic">
              