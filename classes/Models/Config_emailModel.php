<?php

namespace Models;

use MySql;

class Config_emailModel
{
    public static function atualizar_dados_email()
    {
        if(isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $host = $_POST['host'];
            $porta = $_POST['porta'];
           

            $verify = \Painel::selectAllQuery('tb_admin.config_email','WHERE id_empresa = ?',array($_SESSION['id_empresa']));
            if(count($verify) > 0){
                //update
             
                $up = MySql::conectar()->prepare("UPDATE `tb_admin.config_email` SET nome = ?, email = ?, host = ?, porta = ? WHERE id_empresa = ?");
                $up->execute(array($nome,$email,$host,$porta,$_SESSION['id_empresa']));
                \Painel::alertfixed('sucesso','Configurações atualizadas com sucesso!');
            }else{
                //create
                $insert = MySql::conectar()->prepare("INSERT INTO `tb_admin.config_email` VALUES(NULL, ?, ?, ?, ?, ?)");
                $insert->execute(array($nome,$email,$host,$porta,$_SESSION['id_empresa']));
                \Painel::alertfixed('sucesso','Configurações atualizadas com sucesso!');

            }
        }

    }

    public static function pegar_dados_email()
    {
        $verify = \Painel::select('tb_admin.config_email','id_empresa = ?',array($_SESSION['id_empresa']));
        return $verify;
    }

    public static function test_email_host()
    {

        $modal = '
			<div   class="group_modal_padrao">
		   <h2 class="title_modal_padrao">Teste o envio do email</h2>
		   <hr>
		   </div>
			
		   <div class="group_modal_padrao">
           <form id="form_modal_teste" method="post">
			   <div class="des_modal_padrao">
   
			   
			<div class="group_input_elements">
				<input class="block_width email_prospect"  name="email_prospect" type="email" placeholder="Enviar teste para:">
						
			</div>

			<div class="group_input_elements">
			<input class="block_width assunto_prospect"  name="assunto_prospect" type="text"  placeholder="Assunto do email">
		   
			</div>

			<div class="group_input_elements">
				<textarea name="msg" class="block_width email_msg_prospeccao" placeholder="Mensagem no email"></textarea> 
			
			</div>
		   
		   </div>
		   	<div class="group_input_elements">
		   		<input class=" block_width senha" id="senha" type="password" name="senha" placeholder="Senha do email de onde vai ser enviado">
			</div>
            </form>
				   <hr>
           
		   </div>
   
		   <div class="group_modal_padrao">
		 
				<button class="btn_modal_padrao btn_green" id="enviar_teste_email">Testar Envio</button>  
		   
		   </div>
		   ';

           echo $modal;
    }

    public static function enviar_teste_email()
    {
        if(isset($_POST['senha'])){
            $dados_E = \Painel::select('tb_admin.config_email','id_empresa = ?',array($_SESSION['id_empresa']));
            $email_prospect = $_POST['email_prospect'];
            $assunto_prospect = $_POST['assunto_prospect'];
            $email_msg_prospeccao = $_POST['email_msg_prospeccao'];
            $senha = $_POST['senha'];

            $mail = new \Email($dados_E['host'], $dados_E['email'], $dados_E['porta'], $senha , $dados_E['nome']);
            $mail->addAdress($email_prospect, 'Teste de email com Sucesso!');
            $mail->formatarEmail(array('assunto' => $assunto_prospect, 
            'corpo' => $email_msg_prospeccao));
            $mail->enviarEmail();
            if ($mail == true) {
                $res = true;
            }else{
                $res = false;
            }

        }else{
            $res = false;
        }
        
        echo json_encode($res);
    }

   
    
}
