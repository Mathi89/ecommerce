<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}
verificaPermissaoPagina(1)
?>

<div class="container">
<section data-domain="<?= DOMAIN?>" id="" class="section-dashboard-admin">

<div class="section_ValoraPagar">
<div class="ValoraPagar">
 
</div>
</div>

<div class="financeiro_coluna">
<div class="box_financeiro box-f-saida">
        <p>Cadastrar contas a pagar da <?= NOME_EMPRESA ?></p>
        <a class="botao_registrar b_regis_boleto" href="<?= INCLUDE_PATH?>financeiro_contas_pag">Registrar Contas/Boletos</a>
    </div><!-- box_financeiro -->
    <div class="box_financeiro box-f-saida">
        <p>Registre todas as Saídas da <?= NOME_EMPRESA ?></p>
        <a class="disable_btn botao_registrar b_regis_saida" >Registrar Saída</a>
    </div><!-- box_financeiro -->
    <div class="box_financeiro box-f-saida">
        <p>Registre todas as Entradas da <?= NOME_EMPRESA ?></p>
        <a class="disable_btn botao_registrar b_regis_entrada" >Registrar Entrada</a>
    </div><!-- box_financeiro -->
</div><!--  financeiro_coluna -->
<section class="pesquisar_tables_pagamentos_financ">
    <select id="select_table_financeiro">
        <option value="" disabled selected>Filtrar por Data</option>
            <option>Mês Passado</option>
            <option>Este Mês</option>
            <option>Mês que Vem</option>
            <option>Este Ano</option>
        </select>
        <div class="box_financeiros_table_coluna">
    
    <div class="coluna_table_finan">
    
    <h3>Contas a Pagar</h3>
    <table class="table_financeiro">
<thead class="head_table_financeiro">
  <tr>
    <th class="tg-0pky">Nome</th>
    <th class="tg-0lax">Valor</th>
    <th class="tg-0pky">Vencimento</th>
    <th class="tg-0pky">Parc</th>
    <th class="tg-0pky">Status</th>
    <th class="tg-0pky"></th>
  </tr>
</thead>
<tbody class="table_tbody_financeiro">
  
</tbody>
</table>
    </div><!-- coluna_table_finan  -->


    <div class="coluna_table_finan">
   <h3>Contas Pagas</h3>
    <table class="table_financeiro">
<thead class="head_table_financeiro">
  <tr>
    <th class="tg-0pky">Nome</th>
    <th class="tg-0lax">Valor</th>
    <th class="tg-0pky">Vencimento</th>
    <th class="tg-0pky">Parc</th>
    <th class="tg-0pky">Status</th>
    <th class="tg-0pky"></th>
  </tr>
</thead>
<tbody class="table_tbody_financeiro_pagos">
  
</tbody>
</table>
    </div><!-- coluna_table_finan  -->

</div> <!-- box_financeiros_table_coluna -->
</section>




</section>
</div>