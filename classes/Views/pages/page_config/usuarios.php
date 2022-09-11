
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
             <div class="box-title tile-usuarios">
                 <h1 class="titulo titulomais">Todos os Usuários da Equipe</h1>
             </div>
             <div <?php verificaPermissaoMenu(1)?> class="box-title tile-addmore">
                 <a  href="<?= INCLUDE_PATH_SETTING?>cadastrar_user"><i class='btn_add bx bxs-user-plus'></i></a>
             </div>
            
            <div class="allForm">
              
            <table class="table_prospeccao">
            <thead class="head_table_prospeccao">
            <tr>
                <th class="tg-0pky"></th>
                <th class="tg-0lax">Nome</th>
                <th class="tg-0pky">Cargo</th>
                <th class="tg-0pky">Cadastro</th>
                <th class="tg-0pky">Status</th>
                <th class="tg-0pky"></th>
                
            </tr>
            </thead>
                <tbody class="table_tbody_usuarios_settings">
                    <!-- Aqui é preenchido pelo ajax -->
                
                </tbody>
            </table>
            </div>
            </section>
        </section>     
        
</div>

