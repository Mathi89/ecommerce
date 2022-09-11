<!-- <h1>Aqui e o <?= $arr[0]['title'] ?></h1> -->
<section class="section-page-products">
    <div class="content-page-products">
        <!-- <div class="space-work-slide-img"> -->
            <div class="space-img-product-page">
                <?php 
                        $img = \FeaturesCart::getImgProduct($arr[0]['id']); 
                        if($img != false){
                        foreach ($img as $key => $value) { ?>
                            <img class="img-product-page" src="<?=INCLUDE_PATH_VIEWS?>imgsproducts/<?= $value['img_produto'] ?>">
                      <?php  
                            }
                        }else{ ?>
                            <img class="img-product-page" src="<?=INCLUDE_PATH_VIEWS?>imgsproducts/logo.png">
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



            <div class="variacoes-product-page">

            <div class="group-variable-product">
                <label class="title-variacao">Cor</label>
               <select name="color">
                    <option disabled selected value >Selecione uma cor</option>
                    <option value="vermelho">Vermelho</option>
                    <option value="Azul">Azul</option>
                    <option value="Verde">Verde</option>
                    <option value="Amarelo">Amarelo</option>
               </select>
            </div>

            <div class="group-variable-product">
               <label class="title-variacao">Tamanho da blusa</label>
               <select name="color">
                    <option disabled selected value >Selecione um tamanho</option>
                    <option value="P">P</option>
                    <option value="M">M</option>
                    <option value="G">G</option>
                    <option value="GG">GG</option>
               </select>
            </div>


            <div class="group-variable-product">
               <label class="title-variacao">Tamanho do calçado</label>
               <select name="color">
                    <option disabled selected value >Selecione um Tamanho</option>
                    <option value="39/40">39/40</option>
                    <option value="41/42">41/42</option>
                    <option value="44/45">44/45</option>
               </select>
            </div>

            <div class="group-variable-product">
               <label class="title-variacao">Tamanho da calça</label>
               <select name="color">
                    <option disabled selected value >Selecione um tamanho</option>
                    <option value="36">36</option>
                    <option value="38">38</option>
                    <option value="40">40</option>
                    <option value="42">42</option>
               </select>
            </div>
        </div>


        <div class="space-values-product-page">
            <div class="values-product-body">

            <span class="value-padrao-page-product-old"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[2] ?><span class="centavos-preco-produto-page-product-old"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[3]?></span></span>

            <span class="value-padrao-page-product">R$<?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[0] ?><span class="centavos-preco-produto-page-product"><?= \Painel::valueCard($arr[0]['status_promotion'],$arr[0]['value_promotion'],$arr[0]['value'])[1]?></span></span>
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