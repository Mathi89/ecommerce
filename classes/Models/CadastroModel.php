<?php

namespace Models;

use MySql;


class CadastroModel
{

    public static function senEmail()
    {
 
        $mail = new \Email('smtp.hostinger.com.br', 'acesso@digitalaudience.com.br', '29112000Mts', 'DEV DIGITAL');
        $mail->addAdress($_POST['email'], $_POST['nome']);
        $mail->cadastroEmail(array('assunto' => 'Crie sua senha', 'corpo' => 'Acesse o link abeixo e crie sua senha <br/>'.INCLUDE_PATH_LOGIN.'&l=2'));
        $mail->enviarEmail();
        if($mail == true){
            $data = 'sucesso';
        }else{
            $data = 'erro';
        }
        return $data;
    }
    public static function guardarBD()
    {
        $data = array();
        $sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin_imobiliaria` WHERE email = ? ");
        $sql2->execute(array($_POST['email']));
        if ($sql2->rowCount() == 1) {
            $data['erro'] = true;
        } else {

            $cargo = '1';
            $status = 'on';
            $qtd_chave = '0';
            $data_blocked = '';
            $qtd_acesso = '0';
            $hoje = date('Y-m-d');
            if ($_POST['senhaNow'] == 'NDefinirSenha') {
                $senha = '';
                $confirmado = 'off';
                $email = $_POST['email'];
            } else {
                $senha = $_POST['pass'];
                $confirmado = 'on';
                if(!isset( $_POST['email']) ||  $_POST['email'] =='' ||  $_POST['email'] == null)
                {
                    $email = null;
                }else{
                    $email =  $_POST['email'];
                }
            }
            if(!isset($_POST['estado'])){
                $estado = '';
            }else{
                $estado = $_POST['estado'];
            }

            if (\Painel::imagemValida($_FILES['logoarq'])) {
                $imagem = \Painel::uploadImgUser($_FILES['logoarq']);
                $sql = \MySql::conectar()->prepare("INSERT INTO `tb_admin_imobiliaria` VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                if($sql->execute(array($_POST['nome'],  $_POST['rua'],  $_POST['nume_casa'],  $_POST['bairro'],  $_POST['cidade'], $estado ,  $_POST['cep'],  $_POST['telefone'],  $email,  $imagem, $qtd_chave,  $cargo,  $_SESSION['id_user'],  $status, $data_blocked, $qtd_acesso, $_POST['site'], $senha, $confirmado, $hoje)))
                {
                    if ($confirmado == 'off') {
                       $res = \Models\CadastroModel::senEmail();
                       if($res == 'sucesso'){
                        $data['sucesso'] = true;
                       }else{
                        $data['erro'] = true;
                       }
                    }else{
                        $data['sucesso'] = true;
                    }
                }
                
                
            } else {
                $data['erro'] = true;
            }
        }

        die(json_encode($data));
    }
    public static function guardarBDKey()
    {
        $data = array();
        if (isset($_POST['imobiliaria'])) {

            $imobiliaria = $_POST['imobiliaria'];
        } else {
            $imobiliaria = $_SESSION['id_user'];
        }
        $sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin_chave` WHERE (`id_imobiliaria` = ?) AND (email = ? or chave = ?)");
        $sql2->execute(array($imobiliaria, $_POST['email'], $_POST['pass']));
        if ($sql2->rowCount() > 0) {
            $data['erro'] = true;
        } else {
            $status = 'on';
            $qtd_acesso = '0';
            $hoje = date('Y-m-d');
            if ($_POST['type-chave'] == 'Permanente') {
                $dataFinal = '';
                $HoraFinal = '';
                $typeChave = 'Permanente';
            } else {
                $dataFinal = date('Y-m-d', strtotime($_POST['data-acesso'] . '+1 days'));
                $HoraFinal = date('H:i:s');
                $typeChave = 'Temporaria';
            }


            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin_chave` VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?)");
            if ($sql->execute(array($_POST['type-chave'], $_POST['nome'], $_POST['email'], $_POST['telefone'], $imobiliaria, $status, $qtd_acesso, $dataFinal, $_POST['pass'], $hoje, $typeChave, $HoraFinal))) {


                $sql = MySql::conectar()->prepare("UPDATE `tb_admin_imobiliaria` SET  `qtd_chave` = `qtd_chave`+1 WHERE id = ?");
                if ($sql->execute(array($imobiliaria))) {

                    $data['sucesso'] = true;
                } else {
                    $data['erro'] = true;
                }
            }
        }
        die(json_encode($data));
    }
}
