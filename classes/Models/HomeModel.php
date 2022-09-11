<?php

namespace Models;

use MySql;

class HomeModel
{
    public static function trocar_primeira_senha()
    {
        if($_POST['senha'] == $_POST['confsenha']){

            $novaS1 = sha1($_POST['senha']);
            $novaS2 = $_POST['confsenha'];
            $confirm = 'on';
            $status = 1;
            $updateNovaSenha = MySql::conectar()->prepare("UPDATE tb_admin_users SET pass = ?, confirmado = ?, status = ? WHERE id = ?");
            if($updateNovaSenha->execute(array($novaS1,$confirm,$status,$_SESSION['id_user']))){
                session_destroy();
                $res = ['1'];
            }

        }else{
            $res = ['0'];  
        }
       echo json_encode($res);
    }

    public static function boas_vindas()
    {
        if(isset($_SESSION['primeiro_login'])){
            $hr = date('H:i:s');
                    if($hr >= 12 && $hr<18) {
                    $resp = "Boa tarde ";}
                    else if ($hr >= 0 && $hr <12 ){
                    $resp = "Bom dia ";}
                    else {
                    $resp = "Boa noite ";}
                   
                    $res = '<div class="boas_vindas_balao_traco"></div>
                    <div class="conteudo_letras">Oopa! '.$resp.' '.$_SESSION['nome'].'!</div>';
        }else{
            $res = 0;
        }

        echo $res;
        if(isset($_SESSION['primeiro_login'])){
            unset( $_SESSION['primeiro_login'] ); 
        }
         
    }

    public static function pagesDestaques()
    {
       
            $dados=\Painel::selectAllQuery('tb_admin.frames','WHERE status = ?',array('on'));

            return $dados;
    }

    public static function productsDestaques()
    {
        
    }

}
