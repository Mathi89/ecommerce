<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}
verificaPermissaoPagina(1)
?>

<div class="container container_form_pagamentos">
    <section class="corpo_form_pagamantos">
            <a class="voltar_btn_form_financ" href="<?= INCLUDE_PATH?>financeiro"> Voltar</a> <h3>Adicionar Pagamento</h3>
            <div class="form_corpo_pagamentos_financ">
        <form method="post">
            <div class="form_group">
                <input type="text" name="nome_pagamento" placeholder="Nome do Pagamento" required>
            </div>
            <div class="form_group">
                <input type="text" name="valor_pagamento" placeholder="Valor do Pagamento"required>
            </div>
            <div class="form_group">
                <input type="text" name="n_parcelas" placeholder="Quantidade de Parcelas">
            </div>
            <div class="form_group">
                <input id="vencimento" type="text" name="vencimento" placeholder="Data de Vencimento do Pagamento" required>
            </div>
            <div class="form_group">
                <input type="submit" name="acao" value="Inserir Pagamento">
            </div>
        
        </form>
        </div>
    </section>
    
</div>