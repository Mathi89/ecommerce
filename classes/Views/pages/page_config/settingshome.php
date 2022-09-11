
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
                <h1 class="titulo">Configurações do Perfil</h1>
                    <div class="allForm">
              

               <div class="colunas_perfil">
                   <div class="coluna_foto">
                   <?php
                            if($dado['imagem'] == ''){?>
                        <img class="perfil_setting" src="<?= INCLUDE_PATH?>classes/Views/imguser/user_none.png" alt="Perfil">
                            <?php }else{
                          ?>
                      <img class="perfil_setting" src="<?= INCLUDE_PATH?>classes/Views/imguser/<?= $dado['imagem']?>" alt="Perfil">
                      <?php } ?>
                      <form id="form" class="input_none" method="post" enctype="multipart/form-data">
                      <input class="input_none" type="file" name="userimg" id="im_us">
                    </form>
                      
                   </div>
                   <div class="dados_do_perfil">
                       <h2 class="dados_nome_settings"><?= $dado['nome'].' '.$dado['sobre_nome']?></h2>
                       <p class="dados_settings dados_cargo"><?= Painel::$cargos[$dado['cargo']]?></p>
                       <p class="dados_settings dados_data_cad"><?=  Painel::ConverterData($dado['cad_user']) ?></p>
                       <p class="dados_settings dados_empresa"><i class='bx bxs-business'></i><?= ' '. NOME_EMPRESA?></p>
                       <p class="dados_settings dados_city"><i class='bx bxs-map'></i> Guarulhos, São Paulo</p>

                   </div>
               </div>

               <div class="outros_dados">
                   <div class="dados_numero_and_email">
                       <div class="ponta_balao_dados"></div>
                       <p class="dados_todos tel_perfil"><?= $dado['telefone'] ?></p>
                       <p class="dados_todos email_todos_dados"><?= 'Email: '.$dado['email'] ?><i class='edit_email_btn bx bx-edit'></i></p>
                   </div>
                   <div class="box_none_trocaremail">
                       <h3>Preencha a baixo para trocar seu email</h3>
                       <div class="box_trocar_senha EmailNew_alterar_dados_perfil">
                            <input class=" dados_todos EmailNew" type="email" name="EmailNew" placeholder="Digite o novo email para alterar"> 
                       </div>
                       <div class="box_trocar_senha button_alterar_dados_perfil_box">
                           <button  class="button_alterar_dados_perfil ">Mudar Email </button>
                       </div>         
                   </div>
                     </div>
            
            
            </div>
            </section>
        </section>       
</div>

