<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>
<div class="container-checkout" data-domain="<?= DOMAIN?>">
 <h2 id="checkout-title" data-url="<?= INCLUDE_PATH ?>">checkout <span id="valorcompra" data-preco="<?= $arr[1] ?>" > <?= $arr[0] ?></span></h2>

 <!-- <div class="type-pagamento">
    <select id="type-pagto" name="pagto-tipo">
        <option value="" disabled selected>Pagar com</option>
        <option value="0">Pix</option>
        <option value="1">Cartão de Crédito</option>
    </select>
 </div> -->

 <div class="body_checkout">
 <div class="return"></div>

 <div class="locale-types-pagto">
    <div class="type-payment">

        <div class="select-type-payment">
            <h4 class="title-type-pagto">Cartão de Crédito</h4>
            <div class="division-details-payment">
                <input type="radio" name="typepayment" value="creditCard">
                <img class="picture-card" src="<?= INCLUDE_PATH_VIEWS ?>imgsistem/card_logo_type_pagto.gif">
                <p class="description-type-payment">A <?= NOME_EMPRESA ?> aceita vários cartões.</p>
            </div>
        </div>

        <div class="select-type-payment">
            <h4 class="title-type-pagto">Pix</h4>
            <div class="division-details-payment">
                <input type="radio" name="typepayment" value="pix">
                <img class="picture-card" src="<?= INCLUDE_PATH_VIEWS ?>imgsistem/pix_logo.png">
                <p class="description-type-payment">O código Pix gerado para o pagamento é válido por 24 horas após a finalização do pedido.</p>
            </div>
        </div>

        <!-- <div class="select-type-payment">
            <h4 class="title-type-pagto">Boleto</h4>
            <div class="division-details-payment">
                <input type="radio" name="typepayment" value="2">
                <img class="picture-card" src="<?= INCLUDE_PATH_VIEWS ?>imgsistem/boleto_logo.jpg">
                <p class="description-type-payment">O código Pix gerado para o pagamento é válido por 24 horas após a finalização do pedido.</p>
            </div>
        </div> -->


    </div>
 </div>

 <DIV class="content"></DIV>
  <!-- <div class="space-form-checkout space-form-card">
  <form id="form-checkout">
            <div id="form-checkout__cardNumber" class="container"></div>
            <div id="form-checkout__expirationDate" class="container"></div>
            <div id="form-checkout__securityCode" class="container"></div>
            <input type="text" id="form-checkout__cardholderName" />
            <select id="form-checkout__issuer"></select>
            <select id="form-checkout__installments"></select>
            <select id="form-checkout__identificationType"></select>
            <input type="text" id="form-checkout__identificationNumber" />
            <input type="email" id="form-checkout__cardholderEmail" />

            <button type="submit" id="form-checkout__submit">Pagar</button>
            <progress value="0" class="progress-bar">Carregando...</progress>
        </form>
  </div>


  <div class="space-form-checkout space-form-pix">

  </div> -->
 </div>

</div>


    <span id="amount" data-amount="<?= $arr[0] ?>"></span>
