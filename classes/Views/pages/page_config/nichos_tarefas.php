
<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
}
if(isset($_POST['acao_tarefa'])){ \Models\Nichos_tarefasModel::cadastrarTarefa(); };
if(isset($_GET['excluir_tarefa'])){ \Models\Nichos_tarefasModel::excluirTarefa(); };

if(isset($_POST['acao_nicho'])){ \Models\Nichos_tarefasModel::cadastrarNicho();};
if(isset($_GET['excluir_nicho'])){ \Models\Nichos_tarefasModel::excluirNicho(); };
$sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin.nicho_empresa` WHERE status = ? ");
$sql2->execute(array(1));
$dado = $sql2->fetchAll();



$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.tarefas_empresa`");
$sql->execute();
$dadotarefa = $sql->fetchAll();

?>
<div class="containersettings">
	   <!--========== SECTION ==========-->
    <section id="" class="section-painelConfig">
	     <section id="" class="section-configMob">
                <h1 class="titulo titulo_display_inline">Tarefas e Nichos da <?= NOME_EMPRESA?></h1>
                <div class="allForm">
                    <div class="forms_nichos_tarefas">
                        <div class="coluna_forms_nt">
                            <form method="post">
                                <!-- formulario de nicho -->
                                <div class="form_group_nt">
                                     <input name="nicho" placeholder="Nome da área" type="text">
                                </div>

                                <div class="form_group_nt">
                                     <input class="btn_modal_padrao btn_green" name="acao_nicho" value="Cadastrar" type="submit">
                                </div>
                            </form>


                            <form method="post">
                                <!-- formulario tarefas -->
                                <div class="form_group_nt">
                                     <input name="tarefa" placeholder="Nome da Tarefa" type="text">
                                </div>

                                <div class="form_group_nt">
                                     <input class="btn_modal_padrao btn_green" name="acao_tarefa" value="Cadastrar" type="submit">
                                </div>
                            </form>


                       </div>   <!-- FIM DA DIV CLUNA GRID -->
                       <div class="forms_nichos_tarefas">
                            <div class="coluna_forms_nt">
                                <div class="lista_areas_tarefas">

                                        <table class="table_prospeccao">
                                            <thead class="head_table_prospeccao">
                                            <tr>
                                                <th class="tg-0pky">Nicho</th>
                                                <th class="tg-0pky"></th>
                                                <th class="tg-0pky"></th>
                                                
                                            </tr>
                                            </thead>
                                                <tbody data-domain="<?= INCLUDE_PATH?>" class="table_tbody_prospeccao">
                                                <?php
                                                foreach ($dado as $key => $value) {
                                                ?>
                                                <tr>
                                                    <th class="tg-0pky"><?= $value['nome_nicho'] ?></th>
                                                    <th class="tg-0pky"> <a href="">Editar</a> </th>
                                                    <th class="tg-0pky"> <a href="<?= INCLUDE_PATH_SETTING?>nichos_tarefas?excluir_nicho=<?= $value['id']?>">Excluir</a> </th>
                                                
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                
                                                </tbody>
                                        </table>

                                </div>
                                <div class="lista_areas_tarefas">
                                <table class="table_prospeccao">
                                            <thead class="head_table_prospeccao">
                                            <tr>
                                                <th class="tg-0pky">Tarefas</th>
                                                <th class="tg-0pky"></th>
                                                <th class="tg-0pky"></th>
                                                
                                            </tr>
                                            </thead>
                                                <tbody data-domain="<?= INCLUDE_PATH?>" class="table_tbody_prospeccao">
                                                <?php
                                                foreach ($dadotarefa as $key => $value) {
                                                ?>
                                                <tr>
                                                    <th class="tg-0pky"><?= $value['nome_tarefa'] ?></th>
                                                    <th class="tg-0pky"> <a href="">Editar</a> </th>
                                                    <th class="tg-0pky"> <a href="<?= INCLUDE_PATH_SETTING?>nichos_tarefas?excluir_tarefa=<?= $value['id']?>">Excluir</a> </th>
                                                
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                
                                                </tbody>
                                        </table>
                                </div>

                            </div>
                        </div>


                    </div>
              
           
                </div>
        </section>
    </section>       
</div>

