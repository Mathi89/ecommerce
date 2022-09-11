<?php 
namespace Controllers;
class CollectiondestaquesController extends Controller
{
	
	public function executar()
	{
		\Router::rota('collection/'or'collection', function(){
			$res=\Models\CollectiondestaquesModel::url();
			if($res == true){
				$dados=\Models\CollectiondestaquesModel::dadosFrame();
				if($dados == false){
					header('Location: '.INCLUDE_PATH);
					die();
				}
				$this->view = new \Views\MainView('collection/destaque');
				$this->view->render(array($dados));
				echo '
				<script src="'.INCLUDE_CSS_T01.'destaques.js"></script>
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'destaques.css">';
			}else{
				header('Location: '.INCLUDE_PATH);
			}
			
		});
		// \Router::rota('collection', function(){
		// 	$res=\Models\CollectiondestaquesModel::url();
		// 	if($res == true){
		// 		$this->view = new \Views\MainView('collection/destaque');
		// 		$this->view->render(array(/* $infos */));
		// 	}else{
		// 		header('Location: '.INCLUDE_PATH);
		// 	}
			
		// });

		// \Router::rota('settings', function(){
		// 	$this->view = new \Views\MainView('page_config/settingshome','settingsH','settingsF');
		// 	$this->view->render(array('titulo'=>'Configurações iniciais'));
		// 	echo '<script src="'.INCLUDE_PATH_FULL.'javascript/settingshome.js"></script>';
			
		// });
		\Router::rota('collection/settingshome', function(){
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