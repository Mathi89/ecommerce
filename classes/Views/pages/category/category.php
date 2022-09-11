<section class="section-destaques">
    <div class="title-destaques">
        <h3 class="text-title-detaques">Categoria <?= $arr[0]['title'] ?></h3>
    </div>
    <div class="quadro-produtos-destques">



<?php 
$categoria = $arr[0];
foreach ($arr[1] as $key => $card) { ?>

<div class="card-shop"> <!-- COMECO DO CARD -->
        <div class="content-card">

        <div class="space-btn-favorite">
            <!-- <i class='btn-favorite bx bxs-heart' ></i> -->
            <i class='btn-favorite bx bx-heart'></i>
        </div>

            <a href="<?= INCLUDE_PATH.$categoria['slug']."/".$card['slug'] ?>"><div class="space-img-produto">
                <img class="img-produto" src="<?=INCLUDE_PATH_VIEWS?>imgsproducts/<?= ($card['image'] == '')?$card['image'] : 'logo.png' ?>">
            </div></a>

            <a href="<?= INCLUDE_PATH.$categoria['slug']."/".$card['slug'] ?>"><div class="space-title-produto">
                <h3 class="title-produto"><?= \Painel::titleCard($card['title']) ?></h3>
            </div></a>
            <a href="<?= INCLUDE_PATH.$categoria['slug']."/".$card['slug'] ?>"><div class="space-value-produto">
                <span class="value-padrao">R$<?= \Painel::valueCard($card['status_promotion'],$card['value_promotion'],$card['value'])[0] ?><span class="centavos-preco-produto"><?= \Painel::valueCard($card['status_promotion'],$card['value_promotion'],$card['value'])[1]?></span></span>
                <span class="value-promo"><?= \Painel::calculateDesconto($card['status_promotion'],$card['value_promotion'],$card['value']) ?></span>
                <span class="value-parcela">em 12x R$ 3<span class="value-centavos-parcela">99</span><span class="juros-parcela">sem juros</span></span>
            </div>
        <span class="frete-gratis">Frete gratis</span></a>

        </div>
    </div> <!-- FIM DO CARD -->
    
<?php } ?>

</div>
</section>