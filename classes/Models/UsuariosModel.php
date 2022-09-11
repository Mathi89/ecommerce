<?php

namespace Models;

class UsuariosModel
{
    public function carregardados()
    {
        require('../../vendor/autoload.php');
    MercadoPago/SDK::setAccessToken(ACESS_TOKEN);
      $pesquisa  =\Painel::selectAll('tb_admin_users');
      foreach ($pesquisa as $key => $value) {

              echo '
                      <tr class="line_prospeccao">
                      
                      <th class="tg-0pky">';if($value['imagem'] == ''){
                          echo '<img class="perfil_table_user" src="'.INCLUDE_PATH_VIEWS.'imguser/user_none.png">';
                      } else{
                          echo '<img class="perfil_table_user" src="'.INCLUDE_PATH_VIEWS.'imguser/'.$value['imagem'].'">';
                      }echo '</th>
                      <th class="tg-0lax">'.$value['nome'].'</th>
                      <th class="tg-0pky "><p class="tel_prospeccao">'.\Painel::$cargos[$value['cargo']].'</p></th>
                      <th class="tg-0pky ">'.\Painel::ConverterData($value['cad_user']).'</th>
                      <th class="tg-0pky">'.\Painel::$statusUser[$value['status']].'</th>
                      <th class="tg-0pky"><button id="ver_users" data-id_user="'.$value['id'].'" class="btn_ver_user_settings_table" >Ver</button></th>
                  </tr>
              ';
          
        }
      
    }

    public function tarefas_users()
    {
        // $id_fluxo = $_POST['id_fluxo'];
        // $e = $_SESSION['id_empresa'];
        // $select = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.tarefa_user` WHERE id_empresa= ? AND id_tarefa in 
        // (SELECT  tu.id_tarefa FROM `tb_admin.fluxo_cadencia.pontos_contato` as tpc
        // RIGHT JOIN  `tb_admin.pontos_contato.tarefas` as tct ON tpc.id = tct.ponto_contato AND tct.id_empresa = ? 
        // LEFT JOIN (SELECT  * FROM `tb_admin.tarefa_user` WHERE id_empresa = ?  LIMIT 1)tu 
        // ON tu.id_tarefa = tct.id_tarefa and tu.id_empresa = ?
        //  WHERE tpc.id_fluxo = ? AND tpc.id_empresa = ? AND tct.id_tarefa = tu.id_tarefa 
        //  ORDER BY  tpc.ordem, tct.turno_executar ASC )  GROUP BY id_user");
        //     $select->execute(array($e,$e,$e,$e,$id_fluxo,$e));

        // DELETE FROM  `tb_admin.tarefa_user` 
        // WHERE id in
       $query = " SELECT * FROM `tb_admin.tarefa_user` WHERE id in (SELECT id FROM `tb_admin.tarefa_user`  WHERE id_empresa = ? AND id_user = ?";
        
         
            $param[] = $_SESSION['id_empresa'];
            $param[] = $_POST['id_user'];
       if(isset($_POST['tarefas']) && $_POST['tarefas'] != ''){
           $tarefa_antes = 0;
        foreach ($_POST['tarefas'] as $key => $value) {
            $tarefa_antes++;
            if($value != '' || $value != null){
                $query .= " AND id_tarefa != ?";
                $param[] = $value;
            }  
        }
         }
       $query .= ")"; 
        $select  = \MySql::conectar()->prepare($query);
    $select->execute($param);
    if ($select->rowCount() > 0) {
    $teste = $select->fetchAll();
    $true = 0;
    $false = 0;
        foreach ($teste as $key => $value) {
            
            
            $ress = \Painel::update_dele_tarefa($value['id_user'],$value['id'],$value['id_tarefa']);
            if($ress == true){
                $true++;
            }else{
                $false++;
            }
            
            
                
        }
        // echo $ress;
       
               $resp[] = $true;
               $resp[] = $false;
            
    }else{
        $resp[] = 0;
        $resp[] = 0;
    }
    




//AQUI É A PARTE QUE DELETAA
//      $param = [];
//     $query = "DELETE FROM  `tb_admin.tarefa_user` WHERE id in (SELECT id FROM `tb_admin.tarefa_user`  WHERE id_empresa = ? AND id_user = ?";
        
         
//         $param[] = $_SESSION['id_empresa'];
//         $param[] = $_POST['id_user'];
//    if(isset($_POST['tarefas']) && $_POST['tarefas'] != ''){
//     foreach ($_POST['tarefas'] as $key => $value) {
//         if($value != '' || $value != null){
//             $query .= " AND id_tarefa != ?";
//             $param[] = $value;
//         }  
//     }
//      }
//    $query .= ")"; 
//     $select  = \MySql::conectar()->prepare($query);
// $select->execute($param);












  
    $parame = [];
    $total_tarefa = 0;
if(isset($_POST['tarefas']) && $_POST['tarefas'] != null && $_POST['tarefas'] != ''){
        foreach ($_POST['tarefas'] as $key => $vaalor) {
            $total_tarefa++;
//             INSERT INTO `tb_admin.tarefa_user` (id,id_user,id_tarefa,id_empresa) 
// SELECT * FROM (SELECT null,54,26,1) AS tmp
//             WHERE  NOT EXISTS (
//                 SELECT id_tarefa FROM `tb_admin.tarefa_user` WHERE id_tarefa = 26 AND id_user = 54 AND id_empresa = 1
//             ) LIMIT 1;
            $parame = [];
            if($vaalor != '' || $vaalor != null){
                $query = "INSERT INTO `tb_admin.tarefa_user` (id,id_user,id_tarefa,id_empresa)";
                
                $query .= "SELECT * FROM (SELECT null,?,?,?) AS tmp
                WHERE  NOT EXISTS (
                    SELECT id_tarefa FROM `tb_admin.tarefa_user` WHERE id_tarefa = ? AND id_user = ? AND id_empresa = ?
                ) LIMIT 1;";
 
                $parame[] = $_POST['id_user'];
                $parame[] = $vaalor;
                $parame[] = $_SESSION['id_empresa'];
                $parame[] = $vaalor;
                $parame[] = $_POST['id_user'];
                $parame[] = $_SESSION['id_empresa'];
               
               
        $select  = \MySql::conectar()->prepare($query);
        $select->execute($parame);
    
        
            }
            $parame = [];
             
        }
        
    }else{
        $total_tarefa = 0;
    }
    
        $resp[] = $total_tarefa;

        echo json_encode($resp);
    }


    public function ver_user_modal()
    {
        $id_user = $_POST['id_user'];
        $query = 'id = ? AND id_empresa = ?';
        $verify = \Painel::verificarEmpresaOk('tb_admin_users',$query,array($id_user,$_SESSION['id_empresa']));
        if($verify == true){
            

            $select = \Painel::select('tb_admin_users',$query,array($id_user,$_SESSION['id_empresa']));
            $allTarefas = \MySql::conectar()->prepare(" SELECT te.nome_tarefa,te.id,tu.id_tarefa FROM `tb_admin.tarefas_empresa` as te
            LEFT JOIN `tb_admin.tarefa_user` as tu ON tu.id_user = ? AND tu.id_tarefa=te.id AND tu.id_empresa = ?
            ");
            $allTarefas->execute(array($_POST['id_user'],$_SESSION['id_empresa']));
            $allTarefas = $allTarefas->fetchAll();


            echo 
            '
                <div class="group_modal_padrao">
                <h2 class="title_modal_padrao">'.$select['nome'].' '.$select['sobre_nome'].'</h2>
                <hr>
                </div>
                <div class="group_modal_padrao">
                <form id="formatualizar_user" method="post">
                    <select id="select_tualizar_user" style="width: 100%" data-id_user="'.$_POST['id_user'].'" class="multiple" name="tarefas[]" multiple="multiple">';
                        foreach ($allTarefas as $key => $value) {
                           
                                echo ' <option value="'.$value['id'].'"'; echo($value['id'] == $value['id_tarefa'])?'selected':''; echo' >'.$value['nome_tarefa'].'</option> ';
                       
                          }
                   echo ' </select >
                </form>
                    
                <hr>
                </div>
                <div class="group_modal_padrao">
                <button id="atualizar_user" class="btn_modal_padrao btn_green">Atualizar</button>
                 </div>
            ';
        }
        
    }
    
}
?>