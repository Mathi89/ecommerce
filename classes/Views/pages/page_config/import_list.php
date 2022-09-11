
<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
}
$sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin_users` WHERE `id` = ? ");
    $sql2->execute(array($_SESSION['id_user']));
    $dado = $sql2->fetch();
    $dados = $dado['imagem'];

?>
<div class="containersettings">
	   <!--========== SECTION ==========-->
    <section id="" class="section-painelConfig">
	     <section id="" class="section-configMob">
                <h1 class="titulo">Importe lista de Prospects</h1>
                <div class="allForm">
            
               <div class="corpo_importar_prospectos">
                   <div class="img_input_file" data-urllink="<?= INCLUDE_PATH ?>">
                   <i class='img_arquivos bx bxs-folder-plus'></i>
                    <!-- <img class="img_arquivos img_arquivos_vazio" src="<?= INCLUDE_PATH?>classes/Views/imgsistem/pasta_vazia.png"> -->
                    <!-- <img class="img_arquivos img_arquivos_cheia" src="<?= INCLUDE_PATH?>classes/Views/imgsistem/pasta_cheia.png"> -->
                </div>
               <form  method="post" enctype="multipart/form-data">

                    <div class="form_group_import_list">
                            <input id="planilha_input" type="file" name="planilha" >
                    </div>
                    <div class="content_selects">
                    <select name="id_fluxo">
                    <option value="null" disabled selected>Selecione um Fluxo</option>
                        <?php 
                        foreach ($arr[0] as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                       <?php }
                        ?>
                    </select>

                    <select name="id_nicho">
                    <option value="null" disabled selected>Selecione um Fluxo</option>
                        <?php 
                        foreach ($arr[1] as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nome_nicho'] ?></option>
                       <?php }
                        ?>
                    </select>
                </div>

                </form>
                
               
                <div class="form_group_import_list" >
                        <input class="btn_submit_import btn_modal_padrao btn_green" type="submit">
                    </div>
                    <div class="teste_pal"></div>
               </div>
           
                </div>
        </section>
    </section>       
</div>

