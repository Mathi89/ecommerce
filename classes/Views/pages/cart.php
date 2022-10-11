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
            // var_dump($itensCarrinho);
            foreach ($itensCarrinho as $key => $value) { 
               

                $idProduto = explode(':', $key)[0];
                $variacao = explode(':', $key)[1];
                // $idProduto = $key;
                if($variacao > 0){
                    $produtoprecos = \Painel::select('tb_admin.variacoes_produtos','id = ?',array($variacao));
                    if(!isset($produtoprecos['id'])){
                        unset($_SESSION['carrinho'][$key]);
                        continue;
                    }
                    $valor = $value * \Painel::getAmountReal('off','0',$produtoprecos['preco']);
                    $valorDesconto = $value * \Painel::getCalculateDesconto($produtoprecos['status_promotion'],$produtoprecos['value_promotion'],$produtoprecos['preco'])[1];
                }else{

                    $produtoprecos = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));
                    $valor = $value * \Painel::getAmountReal($produtoprecos['status_promotion'],$produtoprecos['value_promotion'],$produtoprecos['value']);
                    $valorDesconto = $value * \Painel::getCalculateDesconto($produtoprecos['status_promotion'],$produtoprecos['value_promotion'],$produtoprecos['value'])[1];
                
                }

                $produto = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));
                $descontoCompra+=$valorDesconto;
                $totalCompra+=$valor;
            ?>
                
              
                    <div class="card-banner-item" id="id-banner<?= $idProduto.'-'.$variacao ?>" data-item="<?= $idProduto.':'.$variacao ?>">
                        <i class='bx bx-trash delete-btn-item-cart' data-item="<?= $idProduto.':'.$variacao ?>" id="delete-item-cart"></i>
                        <div class="row-item-card-top">
                            <?php $img = \FeaturesCart::getImgProduct($produto['id'],"single"); ?>
                        <img class="picture-item-on-cart" src="<?=INCLUDE_PATH_VIEWS_PAINEL?>imgsproducts/<?= ($img['img_produto'] == '')? 'logo.png' : $img['img_produto'] ?>">

                        <div class="descript-product">
                        <h4 alt="<?= $produto['title'] ?>" ><?= \Painel::titleCard($produto['title'],23) ?></h4>
                        <span class="variacao-classe"><?= ($variacao > 0)? \FeaturesCart::getVariation($variacao)['nome'] : "" ?></span>
                        </div>
                    </div>
                        <div class="row-item-card-down">

                        <div class="qtd-product-space">
                            <i id="remove-product-minus" data-item="<?= $idProduto.':'.$variacao ?>" class="bx bx-minus qtd-product-btn "></i> <span class="qtd-number">QTD: <span id="qtd-tem" class="qtd-item<?=$idProduto.'-'.$variacao?>" data-item="<?= $idProduto.':'.$variacao ?>"><?= $value ?></span></span> <i id="add-product-plus" data-item="<?= $idProduto.':'.$variacao ?>" class="bx bx-plus qtd-product-btn"></i>
                        </div>
                            <span class="valor-item-on-cart" id="total-amount-item<?= $idProduto.'-'.$variacao ?>"> <?= \Painel::convertMoney($valor) ?></span>
                        
                            
                        </div>
                    </div>
             
                
                <?php 
            } ?>
                <div class="space-total-cart">
                    <div class="values-cart-final">Desconto <span id="total-amount-promotion" class="total-value-cart desconto-compra"><?= \Painel::convertMoney($descontoCompra) ?></span></div>
                    <div class="values-cart-final">Total <span id="total-amount" class="total-value-cart"><?= \Painel::convertMoney($totalCompra-$descontoCompra) ?></span></div>
                    
                </div>
                    <?php } ?>
            

    
        
    </section>
</div>
