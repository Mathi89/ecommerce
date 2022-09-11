<?php

namespace Models;

use MySql;


class Import_listModel
{
    public static function pegando_fluxos()
    {
        $query = 'WHERE id_empresa = ?';
        $select = \Painel::selectAllQuery('tb_admin.fluxo_cadencia',$query,array($_SESSION['id_empresa']));
        return $select;
    }

    public static function pegando_nichos()
    {
        $query = 'WHERE status = ? AND id_empresa = ?';
        $select = \Painel::selectAllQuery('tb_admin.nicho_empresa',$query,array(1,$_SESSION['id_empresa']));
        return $select;
    }

    public static function importando()
    {
        date_default_timezone_set('America/Sao_Paulo');
        if(!empty($_FILES['planilha']['name'])){
            if(!empty($_POST['id_fluxo'])){
                if(!empty($_POST['id_nicho'])){

        

     $uploadFile = $_FILES['planilha']['name'];
     $extensao = pathinfo($uploadFile,PATHINFO_EXTENSION);
     if($extensao == 'csv')
     {
        $lendo = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
     }else if($extensao == 'xsv'){
        $lendo = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
     }else{
        $lendo = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
     }
     $spreadsheet = $lendo->load($_FILES['planilha']['tmp_name']);
     $sheetdata = $spreadsheet->getActiveSheet()->toArray();
     $sheetcount = count($sheetdata );
     if($sheetcount > 1){
         $data = array();
         $tirar = array("(", ")", " ", "-", "/", ".");

         $id_fluxo = $_POST['id_fluxo'];
         $id_nicho = $_POST['id_nicho'];
         $e = $_SESSION['id_empresa'];
         $select = \MySql::conectar()->prepare("SELECT *, (SELECT  id FROM `tb_admin.fluxo_cadencia.pontos_contato` 
         WHERE id_fluxo = ? ORDER BY ordem ASC LIMIT 1 ) as ponto_contato, (SELECT turno_executar FROM `tb_admin.pontos_contato.tarefas` WHERE ponto_contato = 
         (SELECT  id FROM `tb_admin.fluxo_cadencia.pontos_contato` 
         WHERE id_fluxo = ? ORDER BY ordem ASC LIMIT 1) LIMIT 1) as turno_executar   FROM `tb_admin.tarefa_user` WHERE id_empresa= ? AND id_tarefa in 
         (SELECT id_tarefa FROM `tb_admin.pontos_contato.tarefas` WHERE ponto_contato = 
         (SELECT  id FROM `tb_admin.fluxo_cadencia.pontos_contato` 
         WHERE id_fluxo = ? ORDER BY ordem ASC LIMIT 1) )  GROUP BY id_user");
             $select->execute(array($id_fluxo,$id_fluxo,$e,$id_fluxo));
             $user = $select->fetchAll();
            //  $user2 = $select->fetch();
             $qtd_user = count($user);
            
             if($qtd_user > 0){

             $id_tarefa = $user[0]['id_tarefa']; 
             $ponto_contato = $user[0]['ponto_contato'];
             $turno_executar = $user[0]['turno_executar'];

            //  echo $turno_executar;
            //  return;
             
                 
             
               $Tot =  $sheetcount/$qtd_user;
            //  echoecho (int)$sheetcount;
             $n = 1;
             $i =1;
             foreach ($user as $key => $value) {
                 $i;
                $operator = $value['id_user'];
                $mult = $n++;
                $multpl = $mult*$Tot;
                for ($i; $i < $multpl; $i++) { 
                     # code...
               
        //  for ($i=1; $i < $sheetcount; $i++) { 


            $dono = $sheetdata[$i][1];
            $empresa = $sheetdata[$i][2];
            $tel1 = $sheetdata[$i][3];
            $whatsappNaoTratado = $sheetdata[$i][4];
            $whatsapp = str_replace($tirar, "", $whatsappNaoTratado);
            $cnpjNaoTratado = $sheetdata[$i][5];
            $cnpj = str_replace($tirar, "", $cnpjNaoTratado);
            $instagram = $sheetdata[$i][6];
            $site = $sheetdata[$i][7];
            $email = $sheetdata[$i][8];
            $nicho = $id_nicho;
            
            if($status = $sheetdata[$i][10] == ''){
                $status = -1;
            }else{
                $status = $sheetdata[$i][10];
            }
            $data_retorno = null;
            $obs = null;
            $data_ligou = null;
            $hora_ligou = null;
            $nextLigacao = date('Y-m-d');
            $nvl_fluxo = $ponto_contato;
            $operador = $operator;
            $endereco = $sheetdata[$i][12];
            $secretario = $sheetdata[$i][11];
            

             $data = array(
                'nome_tabela'=>'tb_admin_prospectos',
                'nome_decisor'=>$dono,
                'nome_empresa'=>$empresa,
                'tel_1'=>$tel1,
                'tel_2'=>$whatsapp,
                'cnpj_empresa'=>$cnpj,
                'instagram_empresa'=>$instagram,
                'site_empresa'=>$site,
                'email_empresa'=>$email,
                'nicho_empresa'=>$nicho,
                'ultimo_status'=>$status,
                'data_retorno_ligacao'=>$data_retorno,
                'ultima_observacao_ligacao'=>$obs,
                'ultimo_data_ligou'=>$data_ligou,
                'ultima_hora_ligou'=>$hora_ligou,
                'next_ligacao'=>$nextLigacao,
                'nivel_fluxo_cadencia'=>$nvl_fluxo,
                'tarefa_now'=>$id_tarefa,
                'turno_executar'=>$turno_executar,
                'id_tarefa_on_fluxo'=>1,
                'id_operador'=>$operador,
                'endereco_empresa'=>$endereco,
                'secretario'=>$secretario,
                'id_fluxo'=>$id_fluxo,
                'id_empresa'=>$_SESSION['id_empresa']
                
            );
            
            

            $res = \Painel::insert($data);
            if($res == true){
                \Painel::uploadPlanilha($_FILES['planilha']);
                $res = ['true'];
            }else{
                $res = ['5'];
            }
         
    }
}
     }else{
        $res = ['4'];
     }
         
     }else{
        $res = ['3'];
     }

    }else{
        $res = ['2'];
     }

    }else{
        $res = ['1'];
     }

    }else{
        $res = ['0'];
     }
    echo json_encode($res);
    }
    
}
