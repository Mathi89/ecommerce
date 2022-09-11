<?php 
namespace Controllers;


class Cadastrar_userController extends Controller
{
	
	public function executar()
	{
		\Router::rota('settings/cadastrar_user', function(){
			$this->view = new \Views\MainView('page_config/cadastrar_user','settingsH','settingsF');
			$this->view->render(array('titulo'=>'Configurações iniciais'));
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/cadastrar_user.js"></script>';

			
		});
		
		\Router::rota('settings/cadastrar_user/cargos_carregados', function(){
			\Models\Cadastrar_userModel::cargos_carregados();
		});
		\Router::rota('settings/cadastrar_user/cadastrando_usuario', function(){
			\Models\Cadastrar_userModel::cadastrando_usuario();
		});
	}
}
?>