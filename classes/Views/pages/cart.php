<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>
<div class="container " data-domain="<?= DOMAIN?>">
    <section class="body-cart">
        <h2 class="title-cart" id="urlDomain" data-url="<?= INCLUDE_PATH ?>">Seu Carrinho</h2>
       
            <?php 
            // session_destroy();
            if(isset($_SESSION['carrinho'])){
            $itensCarrinho = $_SESSION['carrinho'];
            $totalCompra = 0;
            $descontoCompra = 0;
            foreach ($itensCarrinho as $key => $value) { 
                $idProduto = $key;
                $produto = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));
                $valor = $value * \Painel::getAmountReal($produto['status_promotion'],$produto['value_promotion'],$produto['value']);
                
                $valorDesconto = $value * \Painel::getCalculateDesconto($produto['status_promotion'],$produto['value_promotion'],$produto['value'])[1];
                
                $descontoCompra+=$valorDesconto;
                $totalCompra+=$valor;
            ?>
                
              
                    <div class="card-banner-item" id="id-banner<?= $idProduto ?>" data-item="<?= $idProduto ?>">
                        <i class='bx bx-trash delete-btn-item-cart' data-item="<?= $idProduto ?>" id="delete-item-cart"></i>
                        <div class="row-item-card-top">
                        <img class="picture-item-on-cart" src="<?= INCLUDE_PATH_VIEWS?>imgsproducts/<?= ($produto['image'] == '')?$produto['image'] : 'logo.png' ?>">

                        <h4 alt="<?= $produto['title'] ?>" ><?= \Painel::titleCard($produto['title'],23) ?></h4>
                        </div>
                        <div class="row-item-card-down">

                        <div class="qtd-product-space">
                            <i id="remove-product-minus" data-item="<?= $idProduto ?>" class="bx bx-minus qtd-product-btn "></i> <span class="qtd-number">QTD: <span id="qtd-tem" class="qtd-item<?=$idProduto?>" data-item="<?= $idProduto ?>"><?= $value ?></span></span> <i id="add-product-plus" data-item="<?= $idProduto ?>" class="bx bx-plus qtd-product-btn"></i>
                        </div>
                            <span class="valor-item-on-cart" id="total-amount-item<?= $idProduto ?>"> <?= \Painel::convertMoney($valor) ?></span>
                        
                            
                        </div>
                    </div>
             
                
                <?php } ?>
                <div class="space-total-cart">
                    <span id="total-amount" class="total-value-cart"><?= \Painel::convertMoney($totalCompra) ?></span>
                    <span id="total-amount-promotion" class="total-value-cart desconto-compra"><?= \Painel::convertMoney($descontoCompra) ?></span>
                </div>
                    <?php } ?>
            

    
        
    </section>
</div>
