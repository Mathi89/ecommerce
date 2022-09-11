
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
    verificaPermissaoPagina(1)
?>
<div class="containersettings">
	   <!--========== SECTION ==========-->
       <section id="" class="section-painelConfig">
	     <section id="" class="section-configMob">
                <h1 class="titulo">Criando Novo Usuário de Equipe</h1>
                    <div class="allForm">
              

               <div class="cadatrar_users_corpo">
                   <div class="coluna_foto">
                       <form class="form_cadastrar_user" method="post">
                           <div class="form_group_inputs two_colun_cadastro">
                               <input class="nomep" type="text" name="p_nome" placeholder="Primeiro Nome">
                               <select class="select_funcao_cadastro_user" name="cargo">
                                  <!-- SENDO ALIMENTADO POR AJAX -->
                               </select>
                           </div>
                           <div class="form_group_inputs">
                               <input class="nomes" type="text" name="s_nome" placeholder="Sobre-Nome">
                           </div>
                           <div class="form_group_inputs">
                               <input class="email" type="email" name="email" placeholder="Email">
                           </div>
                           <div class="form_group_inputs">
                               <input class="cel" class="tel_perfil" type="tel" name="cel" placeholder="Whatsapp">
                           </div>
                           
                    

                       </form>
                       <div class="form_group_inputs">
                               <input class="btn_acao_enviar_cadastro" type="submit" name="acao">
                           </div>
                            
                   
                   </div>
               </div>

              
            
            
            </div>
            </section>
        </section>       
</div>

