<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>
<div class="container" data-domain="<?= DOMAIN?>">
    <section class="banners-rotate-home">
        <div class="content-banners-home">

        <img class="img-banner-home" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/banner1.jpg">
        <img class="img-banner-home" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/banner2.jpg">
        <img class="img-banner-home" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/banner3.webp">
        <img class="img-banner-home" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/banner4.webp">
        <img class="img-banner-home" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/banner5.jpg">
        <img class="img-banner-home" src="<?=INCLUDE_PATH_VIEWS?>imgsistem/banner6.jpg">
        
            
        </div>
    </section>

<?php 
foreach ($arr[0] as $key => $destaque) { ?>

    <section class="secao-alta"> <!-- INICIO SECTION DESTAQUES -->
        <div class="line-fixed">
            <p class="title-emAlta"><?= $destaque['title'] ?> na <?= NOME_EMPRESA ?></p>
        </div>
         <div class="quadro-todos-cards"> <!-- COMECO DO QUADRO DE CARDS -->
        <?php $res=\Home::listProducts($destaque['id']);
        foreach ($res as $key => $card) { ?>

            <div class="card-shop card-shop-slider-emAlta"> <!-- COMECO DO CARD -->
                <div class="content-card">

                <div class="space-btn-favorite">
                    <!-- <i class='btn-favorite bx bxs-heart' ></i> -->
                    <i class='btn-favorite bx bx-heart'></i>
                </div>

                    <a href="<?= INCLUDE_PATH.$card['categoria']."/".$card['slug'] ?>"><div class="space-img-produto">
                        <?php 
                        $img = \FeaturesCart::getImgProduct($card['id'],"single"); ?>
                            <img class="img-produto" src="<?=INCLUDE_PATH_VIEWS?>imgsproducts/<?= ($img['img_produto'] == '')? 'logo.png' : $img['img_produto'] ?>">
                      <?php  

                        ?>
                        
                    </div></a>

                    <a href="<?= INCLUDE_PATH.$card['categoria']."/".$card['slug'] ?>"><div class="space-title-produto">
                        <h3 class="title-produto"><?= \Painel::titleCard($card['title']) ?></h3>
                    </div></a>

                    <a href="<?= INCLUDE_PATH.$card['categoria']."/".$card['slug'] ?>"><div class="space-value-produto">
                        <span class="value-padrao">R$<?= \Painel::valueCard($card['status_promotion'],$card['value_promotion'],$card['value'])[0] ?><span class="centavos-preco-produto"><?= \Painel::valueCard($card['status_promotion'],$card['value_promotion'],$card['value'])[1]?></span></span>
                        <span class="value-promo"><?= \Painel::calculateDesconto($card['status_promotion'],$card['value_promotion'],$card['value']) ?></span>
                        <span class="value-parcela">em 12x R$ 3<span class="value-centavos-parcela">99</span><span class="juros-parcela">sem juros</span></span>
                    </div>
                <span class="frete-gratis">Frete gratis</span></a>

                </div>
            </div> <!-- FIM DO CARD -->
         
        <?php } ?>
   
        </div><!-- FIM DO QUADRO DE CARDS -->

        <div class="space-ver-tudo">
            <a href="<?= INCLUDE_PATH_COLLECTION.$destaque['slug'] ?>">Ver mais <?= $destaque['title'] ?> na <?= NOME_EMPRESA ?></a>
        </div>
    </section><!-- FIM SECTION DESTAQUES -->

<?php } ?>


</div>
