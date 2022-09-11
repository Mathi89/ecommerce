<?php 
namespace Controllers;


class CadastroController extends Controller
{
	

	
	public function executar(){

		
		\Router::rota('cadastro/executar', function(){
			\Models\CadastroModel::guardarBD();
		});
		\Router::rota('cadastro/executar2', function(){
			\Models\CadastroModel::guardarBDKey();
		});
		\Router::rota('cadastro/executar3', function(){
			\Models\CadastroModel::guardarBDKey();
		});
		// \Router::rota('cadastro/sessions', function(){
		// 	\Models\SessionModel::sessions();
		// });
		\Router::rota('cadastro', function(){
			if($_SESSION['cargo'] < 3){ 
				$this->view = new \Views\MainView('cadastroimob');
				$this->view->render(array('titulo'=>'Cadastro'));
				echo '<script src="'.INCLUDE_PATH_FULL.'javascript/cadastrokey.js"></script>
				<script> cadastroJs() </script>';
			}else{
				$this->view = new \Views\MainView('cadastro');
				$this->view->render(array('titulo'=>'Cadastro'));
				echo '<script src="'.INCLUDE_PATH_FULL.'javascript/cadastro.js"></script>
				<script> cadastroJs() </script>';
			}
			
		});
	}
}
?>