<?php 
namespace Controllers;

class StatusController extends Controller
{
	
	public function executar()
	{
		\Router::rota('settings/status', function(){
			$this->view = new \Views\MainView('page_config/status','settingsH','settingsF');
			$this->view->render(array());
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/status.js"></script>';
	
		});

		\Router::rota('settings/status/lista', function () {
			\Models\StatusModel::lista();
		});
		\Router::rota('settings/status/cadastro_status', function () {
			\Models\StatusModel::cadastro_status();
		});
		\Router::rota('settings/status/modal_edit_status', function () {
			\Models\StatusModel::modal_edit_status();
		});
		\Router::rota('settings/status/edit_status', function () {
			\Models\StatusModel::edit_status();
		});
		\Router::rota('settings/status/modal_exclude_status', function () {
			\Models\StatusModel::modal_exclude_status();
		});
		\Router::rota('settings/status/exclude_status', function () {
			\Models\StatusModel::exclude_status();
		});

	}
}
?>