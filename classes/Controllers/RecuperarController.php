<?php 
namespace Controllers;
class RecuperarController extends Controller
{
	

	public function executar(){
		
		\Router::rota('recuperar', function(){
			if(!isset($_GET['chave'])){ \Painel::redirect(INCLUDE_PATH);die();};
			$this->view = new \Views\MainView('recuperar','','');
			$this->view->render(array('titulo'=>'recuperar'));
			if(isset($_POST['acaoSe'])){ \Models\RecuperarModel::checkChave(); };
			
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/loginRedefinir.js"></script> ';
		});
		
	}
}
?>