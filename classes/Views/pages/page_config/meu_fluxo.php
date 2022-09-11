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
                <span><a class="btn_modal_padrao btn_green" href="<?= INCLUDE_PATH_SETTING ?>create_new_fluxo">Criar Novo Fluxo</a></span>
         </div>
                <div class="allForm">
                    <div class="todos_fluxos">
                        <div class="coluna_todos_fluxos">
                            <?php

                            foreach ($arr[0] as $key => $value) {
                            ?>
                                <div id="card<?= $value['id']?>" class="card">
                                    <div id="opt_card_fluxo<?= $value['id']?>" class="opt_card_fluxo">
                                        
                                            <a href="<?= INCLUDE_PATH_SETTING ?>edit_fluxo?fl=<?= $value['id']?>">Editar</a> 
                                             <a href="<?= INCLUDE_PATH_SETTING ?>fluxo?seefluxo=<?= $value['id']?>">Ver</a> 
                                             <button id="del_fluxo" data-id_fluxo="<?= $value['id']?>" >Excluir</button> 
                                        
                                    </div>
                               <i id="opt_card" data-id="<?= $value['id']?>" class='opcfluxo bx bx-dots-vertical-rounded'></i> 
                               <h3><?= $value['nome']?></h3> 
                                    <div class="corpo_card_fluxo">
                                        
                                            <div class="pontos_contato_meu_fluxo">
                                                <div class="num_pontos_contato_meu_fluxo">
                                                    <?php 
                                                    echo $value['qtd'];
                                                    ?>
                                                    
                                                </div>
                                                
                                            </div>
                                            <p>Pontos de Contatos</p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

           
                </div>
        </section>
    </section>       
</div>

