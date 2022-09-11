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
                <h1 class="titulo titulo_display_inline">Editando o ponto de contato <span class="apelido_title"><?= $arr[2]['apelido']?></span></h1>
                <div class="allForm">
                    <div class="corpo_form_create_new_contact">
                <input id="apelido_dia_contato_novo" class="apelido_dia_contato_novo" value="<?= $arr[2]['apelido']?>" type="text" name="apelido" placeholder="Digite um Apelido">
                        <?php
                            foreach ($arr[0] as $key => $value) {

                        ?>

                        <form method="post" data-id_tarefa="<?= $value['id_contato_tarefa'] ?>" id="formpContato<?= $value['id_contato_tarefa'] ?>">
                           
                                <div class="campos_form_tarefas_newcontact">

                                

                                <div class="form_group_partes_createnewcontact">
                                    <select class="select_tarefas" name="tarefas">
                                        <?php
                                            foreach ($arr[1] as $key => $valor) {

                                        ?>
                                        <option value="<?= $valor['id'] ?>" <?=($value['id_tarefa'] == $valor['id'])?'selected':''?> > <?= $valor['nome_tarefa'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <select class="select_turno" name="turno">
                                        <option value="0" <?=($value['turno_executar'] == '0')?'selected':''?> >Manhã</option>
                                        <option value="1" <?=($value['turno_executar'] == '1')?'selected':''?> >Tarde</option>
                                        <option value="2" <?=($value['turno_executar'] == '2')?'selected':''?> >Noite</option>
                                    </select>
                                    <span id="del_campo_modal" data-ponto_contato="<?= $value['ponto_contato'] ?>" data-id_fluxo="<?= $value['id_fluxo'] ?>" data-id_tarefa="<?= $value['id_contato_tarefa'] ?>" class="del_campo_modal span_del_tarefas"> <i class='bx bx-trash'></i> </span>
                                </div>
                            </div>
                           
                           <input type="hidden" value="<?= $_GET['fl']?>" name="fl">
                        </form>
                            <?php
                                }
                            ?>


                         
                    </div>
                    <input class="btn_modal_padrao btn_green" id="acaoformpContato" type="submit" name="acao" value="Atualizar">

                </div>
        </section>
    </section>       
</div>

