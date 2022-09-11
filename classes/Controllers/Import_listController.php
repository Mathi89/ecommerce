<?php 
namespace Controllers;

class Import_listController extends Controller
{
	
	public function executar()
	{
		\Router::rota('settings/import_list', function(){
			$fluxos = \Models\Import_listModel::pegando_fluxos();
			$nichos = \Models\Import_listModel::pegando_nichos();
			$this->view = new \Views\MainView('page_config/import_list','settingsH','settingsF');
			$this->view->render(array($fluxos,$nichos));
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/import_list.js"></script>';
			
		});
	
		\Router::rota('settings/import_list/importando', function(){
			\Models\Import_listModel::importando();
		});
		
	}
}
?>