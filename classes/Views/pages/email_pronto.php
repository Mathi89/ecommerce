<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>

<div class="container">
<section data-domain="<?= DOMAIN?>" id="" class="section-dashboard-admin">

<div class="corpo_email_pronto">

<i id="add_new" class='btn_add btn_add_more_email bx bxs-add-to-queue' ></i>
<table class="table_prospeccao">
            <thead class="head_table_prospeccao">
            <tr>
                <th class="tg-0pky">Nome do Email</th>
                <th class="tg-0lax">Estatísticas</th>
                <th class="tg-0lax"><!-- editar excluir --></th>
                
            </tr>
            </thead>
                <tbody id="table_tbody_emailpronto_lista" data-domain="<?= INCLUDE_PATH?>" class="table_tbody_prospeccao">
                    <!-- Aqui é preenchido pelo ajax -->
                
                </tbody>
            </table>

</div>

</section>
</div>
