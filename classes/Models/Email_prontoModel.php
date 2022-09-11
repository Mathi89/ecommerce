<?php

namespace Models;

use Painel;

class Email_prontoModel
{
    public static function table_tbody_emailpronto_lista()
    {
        
        $sel = \Painel::selectAllQuery('tb_admin.email_pronto','WHERE id_empresa = ?',array($_SESSION['id_empresa']));

        foreach ($sel as $key => $value) {
          
            $sell = \MySql::conectar()->prepare("SELECT COUNT(he.id) enviados, 
            (SELECT COUNT(status) from `tb_admin.historico_email` WHERE id_camp = ? AND status = ?) lidos FROM `tb_admin.historico_email`as he 
            WHERE he.id_camp = ? AND he.id_empresa = ?");
            $sell->execute(array($value['id'],1,$value['id'],$_SESSION['id_empresa']));
            $count = $sell->fetch();
            
            // está pegando a %
            $total = ($count['enviados']? $count['enviados'] : 1);
            $cons = ($count['lidos']? $count['lidos'] : 0)*100;
            // echo substr($cons/$total,0, 5) ."%";  

            echo 
            '
            <tr id="row_email_'.$value['id'].'">
                <th class="tg-0pky th_email_pronto_nome">'.$value['nome'].'</th>
                <th class="tg-0lax"><p class="statistica statistica_envio"><span class="num_envio">'.$count['enviados'].'</span> Enviados</p> <p class="statistica statistica_lido"><span class="num_lido">'.$count['lidos'].'</span> Lidos</p> <p class="statistica statistica_lido"><span class="num_lido">'.(substr($cons/$total,0, 5)).'</span> %</p></th>
                <th class="tg-0lax">  
                <i data-id="'.$value['id'].'" id="edit_email_pronto" class="icon_email_pronto edit_email_pronto bx bx-edit-alt"></i> 
                <i data-id="'.$value['id'].'" id="exclude_email_pronto" class="icon_email_pronto exclude_email_pronto bx bx-trash" ></i>
                 </th>
            </tr>
            ';
        }
    
       
    }

    public static function modal_editar_criar_email_pronto()
    {

        if(!isset($_POST['id_email'])){

            echo $modal = '
			<div class="group_modal_padrao">
		   <h2 class="title_modal_padrao">Crie um email</h2>
		   <hr>
		   </div>
			
		   <div class="group_modal_padrao">
			   <div class="des_modal_padrao">
   
			   
			<div class="group_input_elements">
				<input class="block_width nome_email" name="email_prospect" type="tex" placeholder="Nome do Email:">	
			</div>

			<div class="group_input_elements">
			<input class="block_width assunto_prospect"  name="assunto_prospect" type="text"  placeholder="Assunto do email">
		   
			</div>

			<div class="group_input_elements">
				<textarea name="msg" class="block_width email_msg_prospeccao" placeholder="Mensagem no email"></textarea> 
			
			</div>
		   
		   </div>
				   <hr>
		   </div>
   
		   <div class="group_modal_padrao">

				<button id="button_email_pegar_dados" class=" btn_modal_padrao btn_green" >Criar Email</button>  

		   </div>
		   ';
        }elseif(isset($_POST['id_email'])){
            $id_email = $_POST['id_email'];
            $sel = \Painel::select('tb_admin.email_pronto','id = ? AND id_empresa = ?',array($id_email,$_SESSION['id_empresa']));
            if(!empty($sel['id'])){

                echo $modal = '
                <div class="group_modal_padrao">
            <h2 class="title_modal_padrao">Editando Email</h2>
            <hr>
            </div>
                
            <div class="group_modal_padrao">
                <div class="des_modal_padrao">
    
                
                <div class="group_input_elements">
                    <input class="block_width nome_email" value="'.$sel['nome'].'" name="email_prospect" type="tex" placeholder="Nome do Email:">	
                </div>

                <div class="group_input_elements">
                <input class="block_width assunto_prospect" value="'.$sel['assunto_email'].'"  name="assunto_prospect" type="text"  placeholder="Assunto do email">
            
                </div>

                <div class="group_input_elements">
                    <textarea name="msg" class="block_width email_msg_prospeccao" placeholder="Mensagem no email">'.$sel['text_email'].'</textarea> 
                
                </div>
            
            </div>
                    <hr>
            </div>
    
            <div class="group_modal_padrao">

                    <button data-id="'.$id_email.'" id="button_email_editar_dados" class=" btn_modal_padrao btn_green" >Atualizar Email</button>  

            </div>
            ';
            }else{
                echo
                '
                <h2>Este email não foi encontrado!</h2>
                ';
            }
        }
       
    }

    public static function button_email_pegar_dados()
    {
        if(isset($_POST['nome_email']) && !empty($_POST['nome_email']) && isset($_POST['assunto_prospect']) && !empty($_POST['assunto_prospect']) && isset($_POST['email_msg_prospeccao']) && !empty($_POST['email_msg_prospeccao']) && !isset($_POST['id_email'])){
            $nome_email = $_POST['nome_email'];
            $assunto_prospect = $_POST['assunto_prospect'];
            $email_msg_prospeccao = $_POST['email_msg_prospeccao'];

            $arr = array(
                'nome_tabela'=>'tb_admin.email_pronto',
                'nome'=>$nome_email,
                'assunto_email'=>$assunto_prospect,
                'text_email'=>$email_msg_prospeccao,
                'id_empresa'=>$_SESSION['id_empresa']

            );

            $inser = \Painel::insert($arr);
            $res = $inser;
        }else if(isset($_POST['nome_email']) && !empty($_POST['nome_email']) && isset($_POST['assunto_prospect']) && !empty($_POST['assunto_prospect']) && isset($_POST['email_msg_prospeccao']) && !empty($_POST['email_msg_prospeccao']) && isset($_POST['id_email']) && !empty($_POST['id_email'])){
            $nome_email = $_POST['nome_email'];
            $assunto_prospect = $_POST['assunto_prospect'];
            $email_msg_prospeccao = $_POST['email_msg_prospeccao'];
            $id_email = $_POST['id_email'];

            $up = \MySql::conectar()->prepare("UPDATE `tb_admin.email_pronto` SET nome = ?, assunto_email = ?, text_email = ? WHERE id_empresa = ? AND id = ?");
            if($up->execute(array($nome_email,$assunto_prospect,$email_msg_prospeccao,$_SESSION['id_empresa'],$id_email)))
            {
                $res = true;
            }else{
                $res = false;
            }

        }else{
            $res = false;
        }
        
        echo json_encode($res);
    }

    public static function modal_confirm_exclude()
    {

        if(isset($_POST['id_email']) && !empty($_POST['id_email'])){
            $id_email = $_POST['id_email'];
            $sel = \Painel::select('tb_admin.email_pronto','id = ? AND id_empresa = ?',array($id_email,$_SESSION['id_empresa']));
            if(!empty($sel['id'])){

            
                echo $modal = '
                <div class="group_modal_padrao">
                <h2 class="title_modal_padrao">Quer mesmo excluir:</h2>
                <hr>
                </div>
                <h2 class="title_modal_padrao">'.$sel['nome'].' ?</h2>
                <div class="group_modal_padrao">
                  
                        <hr>
                </div>

                <div class="group_modal_padrao">

                <button data-id="'.$id_email.'" id="exclur_email_dados" class=" btn_modal_padrao btn_green" >Excluir</button>  

                </div>
                ';

            }else{
                echo
                '
                <h2>Este email não foi encontrado!</h2>
                ';
            }
        }


        
    }

    public static function exclur_email_dados()
    {

        if(isset($_POST['id_email']) && !empty($_POST['id_email'])){
            $id_email = $_POST['id_email'];
            $sel = \Painel::select('tb_admin.email_pronto','id = ? AND id_empresa = ?',array($id_email,$_SESSION['id_empresa']));
            if(!empty($sel['id'])){
                $del = \Painel::delete('tb_admin.email_pronto','WHERE id = ? AND id_empresa = ?',array($id_email,$_SESSION['id_empresa']));
                if($del == true){
                    $res = true;
                }else{
                    $res = false;
                }
            }else{
                $res = false;
            }
        }

        echo json_encode($res);
    }

    
    
}
