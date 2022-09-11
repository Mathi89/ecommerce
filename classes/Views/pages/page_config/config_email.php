<?php
// CRIAR PONTOS DE CONTATO DENTRO DO FLUXO CM TAREFAS
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
                <h1 class="titulo titulo_display_inline">Configurações de Email</h1>
                <div class="allForm">
                <div class="all_config_email">
                    <form method="post">
                        <div class="coluna_confg_email">
                            <div class="group_config_email">
                                <input type="tetx" name="nome" value="<?= @$arr[0]['nome'] ?>"  placeholder="Nome" require>
                            </div>

                            <div class="group_config_email">
                                <input type="email" name="email" value="<?= @$arr[0]['email'] ?>" placeholder="Email a ser usado" require>
                            </div>
                        </div>

                        <div class="coluna_confg_email">
                            <div class="group_config_email">
                                <input type="text" name="host" value="<?= @$arr[0]['host'] ?>" placeholder="Host do Server SMTP" require>
                            </div>

                            <div class="group_config_email">
                                <input type="tel" value="<?= @$arr[0]['porta'] ?>" name="porta"  placeholder="Porta" require>
                            </div>
                        </div>

                        <div class="group_config_email config_email_senha">
                                <!-- <input class="senha_config_email" type="password" name="senha"  placeholder="Senha do email" require> -->
                                <p class="senha_config_email">Sua senha nunca será armazenada em nosso banco de dados. Portanto você só vai inserir a senha no momento de anviar emails.</p>
                        
                                <p class="senha_config_email">Todos os email que você e sua equipe enviarem, será a partir deste email acima.</p>
                       </div>
                        
                       <div class="coluna_confg_email">
                           <p id="test_email" class="btn_modal_padrao btn_blue">Testar Envio</p>
                            <input type="submit" name="acao" value="Atualizar" class="btn_modal_padrao btn_green">
                        </div>
                    </form>
                </div>
                </div>
        </section>
    </section>       
</div>

