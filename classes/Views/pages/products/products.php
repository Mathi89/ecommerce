<!-- <h1>Aqui e o <?= $arr[0]['title'] ?></h1> -->
<section class="section-page-products">
    <div class="content-page-products">
        <!-- <div class="space-work-slide-img"> -->
            <div class="space-img-product-page">
                <?php 
                        $img = \FeaturesCart::getImgProduct($arr[0]['id']);
                         if($img != false){
                        foreach ($img as $key => $value) { ?>
                            <img class="img-product-page" src="<?=INCLUDE_PATH_VIEWS_PAINEL?>imgsproducts/<?= $value['img_produto'] ?>">
                      <?php  
                            }
                        }else{ ?>
                            <img class="img-product-page" src="<?=INCLUDE_PATH_VIEWS_PAINEL?>imgsproducts/logo.png">
                      <?php  

                        }
                        ?>

            </div>
        <!-- </div> -->
        <div class="space-content-text">
            <div class="space-loja-name-avaliacao">
                <span class="name-loja"><?= NOME_EMPRESA ?></span><span class="avaliacao-produto"><i class='bx bxs-star'></i>(4.5)</span>
            </div>

            <div class="space-title-value-product">
                <h2 id="title-page" class="title-page-product" data-url="<?= INCLUDE_PATH ?>"><?= $arr[0]['title'] ?></h2>
                
            </div>


            <?php 
if($arr[0]['type'] == "recarga" && $arr[0]['objeto'] != "combo"){ ?>

<div class="variacoes-product-page">

            <div class="group-variable-product">
                <!-- <label class="title-variacao">Cor</label> -->
               <select class="select-variacao-recarga" name="recargavariable">
                    <option disabled selected value >Escolha uma opção</option>

                    <?php 
                    $contselect = 0;
                    foreach ($arr[1] as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                  <?php 
                  $contselect++;
                  }
                    
                    ?>
                    
               </select>
            </div>
</div>

<?php }else if($arr[0]['objeto'] == "combo"){ ?>


    <div class="variacoes-product-page">

            <div class="group-variable-product">
                <!-- <label class="title-variacao">Cor</label> -->
              <div class="base-combo-itens">

              <div class="itens-combo-grid-space">
                    <?php 
                    foreach ($arr[2] as $key => $value) { ?>
                        <div class="iten-combo-object"><?= $value['nome'] ?></div>
                  <?php  }
                    
                    ?>
                    
                    </div>
               </div>
            </div>
</div>


<?php } ?>


        <div class="space-values-product-page">
            <div class="values-product-body">

            <span class="value-padrao-page-product-old"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[2] ?><span class="centavos-preco-produto-page-product-old"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[3]?></span></span>

            <?php 
            if($arr[0]['type'] == "recarga" && $contselect  > 1){
                $valores = FeaturesCart::getPrecosVariacao($arr[0]['id']);
                ?>

                <span class="value-padrao-page-product">R$<?= \Painel::valueCard($arr[0]['status_promotion'],$valores[0],$arr[0]['value'])[0] ?> - R$<?= \Painel::valueCard($arr[0]['status_promotion'],$valores[1],$arr[0]['value'])[0] ?><span class="centavos-preco-produto-page-product"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[1]?></span></span>

           <?php }else{ ?>
                    <span class="value-padrao-page-product">R$<?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[0] ?><span class="centavos-preco-produto-page-product"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[1]?></span></span>
            <?php }
            ?>
            
            <span class="value-parcela">em 12x R$ 3<span class="value-centavos-parcela">99</span><span class="juros-parcela">sem juros</span></span>

            </div>
            <div class="values-product-body">

            <span class="percent-descont">
            <?= \Painel::calculateDesconto($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value']) ?>
        </span>

            </div>


        </div>

        <div class="qtd-product-space">
                <i id="remove-product-minus" class='bx bx-minus qtd-product-btn '></i> <span class="qtd-number">QTD: <span id="qtd-tem" data-item="<?= $arr[0]['id'] ?>" >1</span></span> <i id="add-product-plus" class='bx bx-plus qtd-product-btn'></i>
            </div>    

        

        <div class="description-product-page">
            <span class="title-space-description">Descrição</span>
            <div class="body-description-page">
                <h4><?= $arr[0]['title'] ?></h4>
                <p><?= $arr[0]['description'] ?></p>

            </div>
        </div>

        

        </div>
    </div>
</section>