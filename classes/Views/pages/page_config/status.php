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
                <h1 class="titulo titulo_display_inline">Status de Perdido da <?= NOME_EMPRESA?></h1>
                <div class="allForm">
                    <div class="forms_nichos_tarefas">
                        <!-- <div class="coluna_forms_nt"> -->
                            <form method="post" class="box_form">
                                <!-- formulario de nicho -->
                                <div class="form_group_nt">
                              
                                     <input id="nome_status" name="status" placeholder="Nome do Perdido" type="text">
                                     <div class="group_checkbox_continue">
                                         <div class="switch__container">
                                        <input id="switch-shadow" class="continue_checkk switch switch--shadow" name="continue_checkbox" type="checkbox" />
                                        <label for="switch-shadow"></label>
                                        
                                    </div> <span>Nesse status o prospecto continua na lista</span>
                                       
                                     </div>
                                     
                                    
                                </div>

                                <div class="form_group_nt">
                                     <p id="cad_sttaus" class="btn_modal_padrao btn_green">Cadastrar</p>
                                </div>
                            </form>




                       <!-- </div>   FIM DA DIV CLUNA GRID -->
                       <div class="forms_nichos_tarefas">
                            <!-- <div class="coluna_forms_nt"> -->
                                <div class="lista_areas_tarefas">

                                        <table class="table_prospeccao">
                                            <thead class="head_table_prospeccao">
                                            <tr>
                                                <th class="tg-0pky">Status</th>
                                                <th class="tg-0pky"></th>
                                                
                                                
                                            </tr>
                                            </thead>
                                                <tbody id="table_status" data-domain="<?= INCLUDE_PATH?>" class="table_tbody_prospeccao ">
                                                    <!-- ESTÁ SENDO ALIMENTADO PELO AJAX -->
                                                <th class="tg-0pky ocupar_spaco">  </th>
                                                <th class="tg-0pky ocupar_spaco"> </th>
                                                </tbody>
                                        </table>

                                </div>
                               

                            <!-- </div> -->
                        </div>


                    </div>
              
           
                </div>
        </section>
    </section>       
</div>

