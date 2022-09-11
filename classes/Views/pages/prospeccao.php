<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>
<div class="tela_modal_status_observacao_prospeccao">
    <!--MODAL É GERADA AQUI COM AJAX-->
</div>

<div class="tela_modal_ver_empresa_prospeccao">

    <!-- PREENCHIDO PELO AJAX -->
</div>

<div class="container container_style_prospeccao">
<section data-domain="<?= DOMAIN?>" id="" class="section-dashboard-admin">
<div class="btn_paginacao_prospeccao_header">
    <div class="option_prospect">
         <div class="results_ligacoes">
            <!-- SENDO ALIMENTADO PELO AJAX -->

           
            <div class="status_ligacoes_hoje">
            <span class="number_ligacoes"></span>
                <p class="text_ligacoes">Visitas</p>
            </div>
            <div class="status_ligacoes_hoje">
                <span class="number_ligacoes"></span>
                <p class="text_ligacoes">Contatos</p>
            </div>
       
        </div>
        <select id="fluxo_on_prospeccao" name="fluxo_on_prospeccao">
            <?php
            if(isset($_GET['fl'])){
                $fl = $_GET['fl'];
            }else{
                $fl = null;
            }
            foreach ($arr[0] as $key => $value) { ?>

                <option value="<?= $value['id'] ?>" <?=($value['id'] == $fl)? 'selected' : '' ?> ><?= $value['nome'] ?></option>

            <?php } ?>
        </select>

    </div>
       
        <div class="overflow_rows_pt_contato">
            
            <ul>
                 <!-- <li><button class="areafluxo fl0" data-areapagina="0">Todos</button></li>  -->
                <!-- <li><button class="areafluxo fl1" data-areapagina="1">FL 1</button></li> 
                <li><button class="areafluxo fl2" data-areapagina="2">FL 2</button></li>
                <li><button class="areafluxo fl3" data-areapagina="3">FL 3</button></li>
                <li><button class="areafluxo fl4" data-areapagina="4">FL 4</button></li>
                <li><button class="areafluxo fl5" data-areapagina="5">FL 5</button></li> -->
                
                <!-- ESTÁ SENDO ALIMENTADO POR AJAX (fluxo_on_prospeccao) -->
        </div>
    
    
    
</div>
    <div class="page_principal_prospeccao">
        <div class="table_section_prospeccao">
            <div class="min_header_info_prospeccao_table">
                 <h3 class="status_areas_prospeccao" data-areaatual="0"><p class='class_p_dataarea' data-areaatual='0'>Todos os Novos Leads</p></h3>
                <input class="search " type="search" name="search" placeholder="Procura quem ?">
                <select class="select_nicho_prospeccao">
                    <!-- ESTÁ SENDO ALIMENTADO POR AJAX -->
                </select>
            </div>
       
        <table class="table_prospeccao">
            <thead class="head_table_prospeccao">
            <tr>
                <th class="tg-0pky">Decisor</th>
                <th class="tg-0lax">Empresa</th>
                <th class="tg-0pky">Telefone</th>
                <th class="tg-0pky "></th>  <!-- th_table_prospeccao -->
                <th class="tg-0pky button_here"></th>
                
                
            </tr>
            </thead>
                <tbody data-domain="<?= INCLUDE_PATH?>" class="table_tbody_prospeccao">
                    <!-- Aqui é preenchido pelo ajax -->
                
                </tbody>
            </table>

        </div>
    </div>
</section>
</div>
