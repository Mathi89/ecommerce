<?php
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
             <div class="header_page_fluxo">
                  <h1 class="titulo titulo_display_inline">Seu fluxo de cadência</h1>
                <span title="Volte ao menu (Meus Fluxos)" ><a class="btn_modal_padrao btn_blue" href="<?= INCLUDE_PATH_SETTING ?>meu_fluxo">Voltar</a></span>
                <span title="Crie um novo ponto de contato" ><a class="btn_modal_padrao btn_green" href="<?= INCLUDE_PATH_SETTING ?>create_new_contact?fl=<?= $arr[0] ?>">Add Novo Dia</a></span>
             </div>
               <div class="alldays_contatos">
                    <div class="group_a_contatos_days">
                        
                            <?php foreach ($arr[1] as $key => $value) { ?>

                            <div data-idfluxo="<?= $_GET['seefluxo']?>" class="tr_dados">
                                <span><?= $value['ordem']; ?></span>
                                <span><?= $value['apelido']; ?></span>
                                <span><?= $value['qtd']; ?></span>
                                <span title="Adicione mais tarefas" ><a  href="<?= INCLUDE_PATH_SETTING?>add_tarefas?fl=<?= $_GET['seefluxo']?>&pcontato=<?= $value["id"]?>"><i id="opt_add_pcontato"  class="opt bx bxs-add-to-queue"></i></a></span>
                                <span title="Edite este ponto de contato e tarefas contidas nele" ><a href="<?= INCLUDE_PATH_SETTING?>edit_pcontato?fl=<?= $_GET['seefluxo']?>&pcontato=<?= $value['id']?>"><i id="opt_edit_fluxo"  class='opt bx bx-edit-alt'></i></a></span>
                                <span title="Exclua este ponto de contato e tarefas contidas nele" ><i id="opt_trash_fluxo" data-id="<?= $value['id']?>" class='opt bx bx-trash' ></i></span>
                                
                            </div>

                            <?php } ?>
                        
                    </div>
                </div>
         </section>
    </section>
</div>
