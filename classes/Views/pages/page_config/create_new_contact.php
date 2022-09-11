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
                <h1 class="titulo titulo_display_inline">Crie mais um ponto de contato para seu fluxo</h1>
                <div class="allForm">
                    <div class="corpo_form_create_new_contact">
                        <form method="post" id="formpContato1">
                           
                                <div class="campos_form_tarefas_newcontact">

                                <input id="apelido_dia_contato_novo" class="apelido_dia_contato_novo" type="text" name="apelido" placeholder="Digite um Apelido">

                                <div class="form_group_partes_createnewcontact">
                                    <select class="select_tarefas" name="tarefas">
                                    <option value="null" disabled selected>Selecione a Tarefa</option>
                                    <?php
                                        foreach ($arr[0] as $key => $value) {

                                    ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['nome_tarefa'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                    <select class="select_turno" name="turno">
                                    <option value="null" disabled selected>Selecione um Turno</option>
                                        <option value="0">Manhã</option>
                                        <option value="1">Tarde</option>
                                        <option value="2">Noite</option>
                                    </select>
                                    <span class="span_add_tarefas" id="add-campo" data-fl="<?= $_GET['fl']?>"> <i class='bx bx-add-to-queue' ></i> </span>
                                </div>
                            </div>

                           <input type="hidden" value="<?= $_GET['fl']?>" name="fl">
                        </form>
                         
                    </div>
                    <input class="btn_modal_padrao btn_green" id="acaoformpContato" type="submit" name="acao" value="Cadastrar">

                </div>
        </section>
    </section>       
</div>

