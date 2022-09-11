<?php

namespace Models;

class RecuperarModel
{

    public static function checkChave()
    {
        
        if (isset($_GET['chave']) && isset($_POST['acaoSe'])) {
            if ($_POST['password'] == $_POST['Cpassword']) {

                $check = \Painel::checkChave($_GET['chave'], $_POST['password'], $_POST['email']);
                if ($check == 'noUser') {
                    \Painel::alertfixed('error', 'Este email nao existe em nosso banco de dados');
                } else if ($check == 'noChave') {
                    \Painel::alertfixed('error', 'Esta chave de recuperacao nao existe');
                } else if ($check == 'errorDelChave') {
                    \Painel::alertfixed('error', 'Tivemos um erro com esta chave de redefinicao. Por favor redefina novamente clicando <a href="' . INCLUDE_PATH . 'recuperar">Aqui</a>');
                } else if($check == 'Scerto') {
                    \Painel::alertfixed('sucesso', 'Sua senha foi redefinida com sucesso. <a href="'.INCLUDE_PATH_LOGIN.'">Faca login novamente</a> ');
                   
                }
            } else {
                \Painel::alertfixed('atencao', 'Sua senha e confirmar senha nao sao iguais');
            }
        } else {
            \Painel::alertfixed('error', 'Esta chave de recuperacao nao existe');
        }
    }
   
}
