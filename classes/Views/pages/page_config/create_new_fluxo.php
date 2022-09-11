
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
                <h1 class="titulo titulo_display_inline">Crie Seu Novo Fluxo de Cadência</h1>
                <div class="allForm">
                    <div class="corpo_create_new_fluxo">
                        <div class="form_div_create_new_fluxo">


                            <form method="post" >
                                <div class="corpo_dentro_form">


                                    <div class="form_group_create_new_fluxo">
                                        <input type="text" name="nome" placeholder="Ex: Clinica Odontologica">
                                    </div>
                                   
                                </div>
                                <input class="btn_modal_padrao btn_green" type="submit" name="acao" value="Criar Fluxo">
                            </form>


                        </div>
                    </div>

           
                </div>
        </section>
    </section>       
</div>

