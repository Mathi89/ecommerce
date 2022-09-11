<?php

namespace Models;

use MySql;


class SettingshomeModel
{
    public static function geral_perfil_mudar()
    {
      if (\Painel::imagemValida($_FILES['userimg'])) {
        if($IMGNomeMudado = \Painel::uploadImgUser($_FILES['userimg'])){



          $checkOld = MySql::conectar()->prepare("SELECT imagem FROM `tb_admin_users` WHERE id = ?");
                  if($checkOld->execute(array($_SESSION['id_user']))){
                    $dadoOld  = $checkOld->fetch();
                    $imgAntiga = $dadoOld[0];
                  }


              $updateImg = MySql::conectar()->prepare("UPDATE `tb_admin_users` SET imagem = ? WHERE id = ?");
            if($updateImg->execute(array($IMGNomeMudado,$_SESSION['id_user']))){

                    //CHECANDO SE A IMAGEM FOI ADICIONADA AO BD
                  $check = MySql::conectar()->prepare("SELECT imagem FROM `tb_admin_users` WHERE id = ?");
                  if($check->execute(array($_SESSION['id_user']))){
                    $dado  = $check->fetch();
                    if($dado[0] == $IMGNomeMudado){
                      \Painel::deleteImgUser($imgAntiga);
                      $res = ['10']; //IMAGEM ALTERADA COM SUCESSO
                    }else{
                      \Painel::deleteImgUser($IMGNomeMudado);
                      $res = ['02'];// IMAGEM NAO DEU PRA ALTERAR
                    }
                  }
              
            }else{
              \Painel::deleteImgUser($IMGNomeMudado);
              $res = ['01']; // ERRO AO UPAR A IMAGEM
            }
        }else{
          $res = ['01'];// ERRO AO UPAR A IMAGEM
        }
        
      }else{
        $res = ['00']; // IMAGEM INVALIDA
      }
     echo json_encode($res);
      
    }

    public static function NewEmail(){
      $emailage = $_SESSION['email'];
      $nome = $_SESSION['nome'];
      $gerateToken = \Painel::geratorTokenEmailNew($_POST['EmailNew'],$emailage);
      if($gerateToken == 'existEmailNew'){
        $res = ['erro1'];
      }else if($gerateToken == 'errotentedps'){
        $res = ['erro2'];
      } else{
        $mail = new \Email('smtp.hostinger.com.br','contato@digitalaudience.com.br','29112000Mts',NOME_EMPRESA);      
              $mail->addAdress($_POST['EmailNew'],$nome);
              $mail->formatarEmail(array('assunto'=>'Redefinir Email','corpo'=>'<a href="'.INCLUDE_PATH_LOGIN.'&chave='.$gerateToken.'">Complete a mudanca do seu email</a>'));
              $mail->enviarEmail();
              if($mail == true){
                $res = ['sucesso'];
                session_destroy();
            }else{
              $res = ['erro3'];
        }
      }
  
             echo json_encode($res);
    }
    
}
