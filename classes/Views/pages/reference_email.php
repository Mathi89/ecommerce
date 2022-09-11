<?php
date_default_timezone_set('America/Sao_Paulo');
if(isset($_GET['ref'])){
    $ref = $_GET['ref'];
    $now = date('Y-m-d H:i:s');

    $up = \MySql::conectar()->prepare("UPDATE `tb_admin.historico_email` SET `status`= ?, qtd_abertura = qtd_abertura+1, ultima_abertura = ? WHERE ref = ?");
    $up->execute(array(1,$now,$ref));

}
?>