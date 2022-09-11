<?php
// CRIAR PONTOS DE CONTATO DENTRO DO FLUXO CM TAREFAS
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
}

?>
<div class="containersettings">
	   <!--========== SECTION ==========-->
    <section id="" class="section-painelConfig">
	     <section id="" class="section-configMob">
                <h1 class="titulo titulo_display_inline">Editando o Fluxo <span class="fluxo_title"><?= $arr[0]['nome']?></span></h1>
                <div class="allForm">
                    <div class="corpo_form_create_new_contact">
                <input data-id_fluxo="<?= $_GET['fl'] ?>" id="nome_fluxo_edit" class="nome_fluxo_edit" value="<?= $arr[0]['nome']?>" type="text" name="apelido" placeholder="Digite um Apelido">
                         
                    </div>
                    <input class="btn_modal_padrao btn_green" id="acaoformpContato" type="submit" name="acao" value="Atualizar">

                </div>
        </section>
    </section>       
</div>

