<?php

namespace Models;



class LogarModel
{

    public static function Login()
    {

        if (isset($_POST['acaoLo'])) {

            $table2 = 'tb_admin_users';
            $query = ' email = ? AND pass = ?';
            $email = $_POST['user'];
            $pass = $_POST['password'];
            if ($sql = \Painel::logar($table2, $query, $email, $pass)) {


                @$_SESSION['login'] = true;
                @$_SESSION['email'] = $email;
                @$_SESSION['password'] = $pass;
                @$_SESSION['cargo'] = $sql['cargo'];
                @$_SESSION['nome'] = $sql['nome'];
                @$_SESSION['telefone'] = $sql['telefone'];
                @$_SESSION['primeiro_login'] = true;
                @$_SESSION['id_user'] = $sql['id'];
                @$_SESSION['id_empresa'] = $sql['id_empresa'];
                if (isset($sql['logo'])) {
                    @$_SESSION['logo'] = $sql['logo'];
                };
                \Painel::redirect(INCLUDE_PATH);

                
            } else {
                //Falhou
                \Painel::alertfixed('error', 'Usuário ou senha incorretos');
            }
        }
    }

    public static function AlterarEmail(){

        if(isset($_GET['chave']) && isset($_POST['acaoEM']) ){
           $token = $_GET['chave'];
           $emailAge = $_POST['emailantigo'];
           $emailNew = $_POST['emailnovo'];
           $pass = $_POST['pass'];
           $verify = \Painel::verifyEmailNew($emailAge,$emailNew,$token,sha1($pass));

           if($verify == 'invalidEmail'){
               \Painel::alertfixed('error','Este email nao existe em nosso sistema');

           } else if($verify == 'invalidpass'){
            \Painel::alertfixed('atencao','Sua senha esta incorreta, tente novamente');

           }else if($verify == 'invalidtoken'){
            \Painel::alertfixed('error','Seu token de alteracao de email nao e valido');
            
           }else if($verify == 'tentedps'){
            \Painel::alertfixed('atencao','Ocorreu algum erro, tente novamente');
            
           }else if($verify == 'sucesso'){
           \Painel::alertfixed('sucesso','Email alterado com sucesso. <a href="'.INCLUDE_PATH_LOGIN.'">Faca login novamente</a> ');
           
           }
        }
       
    }
   
    public static function RecuperarSenha()
    {

        if (isset($_POST['acaoRe'])) {
            $link = \Painel::gerarChave($_POST['email']);
            if ($link == 'noExiste') {
                \Painel::alertfixed('error', 'Este email nao existe em nosso sistema');
            } else if ($link == 'noConfirm') {
                \Painel::alertfixed('atencao', 'Por favor, primeiro crie sua senha enviado para seu email');
            } else if ($link == 'Tnovamente') {
                \Painel::alertfixed('error', 'Ocorreu um erro, tente novamente mais tarde');
            } else {

                $mail = new \Email('smtp.hostinger.com.br', 'contato@digitalaudience.com.br', '587', '29112000Mts', NOME_EMPRESA);
                $mail->addAdress($_POST['email'], $link["nome"]);
                $mail->formatarEmail(array('assunto' => 'Redefinir Senha', 'corpo' => '<a href="' . INCLUDE_PATH . 'recuperar&chave=' . $link["chave"] . '">REDENINA SUA SENHA POR AQUI</a>'));
                $mail->enviarEmail();
                if ($mail == true) {
                    \Painel::alertfixed('sucesso', 'Foi enviado um link para redenir sua senha por email');
                } else {
                    \Painel::alertfixed('error', 'Ocorreu um erro, tente novamente mais tarde');
                }
            }
        }
    }
}
