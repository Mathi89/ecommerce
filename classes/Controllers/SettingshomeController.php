<?php 
namespace Controllers;
class SettingshomeController extends Controller
{
	
	public function executar()
	{
		\Router::rota('settings/', function(){
			$this->view = new \Views\MainView('page_config/settingshome','settingsH','settingsF');
			$this->view->render(array('titulo'=>'Configurações iniciais'));
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/settingshome.js"></script>';

			
		});
		\Router::rota('settings', function(){
			$this->view = new \Views\MainView('page_config/settingshome','settingsH','settingsF');
			$this->view->render(array('titulo'=>'Configurações iniciais'));
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/settingshome.js"></script>';
			
		});
		\Router::rota('settings/settingshome', function(){
			$this->view = new \Views\MainView('page_config/settingshome','settingsH','settingsF');
			$this->view->render(array('titulo'=>'Configurações iniciais'));
			echo '<script src="'.INCLUDE_PATH_FULL.'javascript/settingshome.js"></script>';

			
		});
		\Router::rota('settings/settingshome/geral_perfil_mudar', function(){
			\Models\SettingshomeModel::geral_perfil_mudar();
		});
		\Router::rota('settings/settingshome/NewEmail', function(){
			\Models\SettingshomeModel::NewEmail();
		});
		// \Router::rota('settings/settingshome/relistar', function(){
		// 	\Models\SettingshomeModel::relistar();
		// });
		// \Router::rota('settings/settingshome/relistar2', function(){
		// 	\Models\SettingshomeModel::relistar2();
		// });
	}
}
?>