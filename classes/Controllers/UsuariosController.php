<?php 
namespace Controllers;


class UsuariosController extends Controller
{
	
	public function executar()
	{
		\Router::rota('settings/usuarios', function(){
			$this->view = new \Views\MainView('page_config/usuarios','settingsH','settingsF');
			$this->view->render(array('titulo'=>'Configurações iniciais'));
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/usuarios.js"></script>';			
		});
		
		\Router::rota('settings/usuarios/carregardados', function(){
			\Models\UsuariosModel::carregardados();
		});
		\Router::rota('settings/usuarios/ver_user_modal', function(){
			\Models\UsuariosModel::ver_user_modal();
		});
		\Router::rota('settings/usuarios/tarefas_users', function(){
			\Models\UsuariosModel::tarefas_users();
		});
		
	}
}
?>