<?php 
namespace Controllers;

class Config_emailController extends Controller
{
	
	public function executar()
	{
				\Router::rota('settings/config_email', function(){
	
					if(isset($_POST['acao'])){\Models\Config_emailModel::atualizar_dados_email();}
					$take = \Models\Config_emailModel::pegar_dados_email();
					$this->view = new \Views\MainView('page_config/config_email','settingsH','settingsF');
					$this->view->render(array($take));
					echo '<script src="'.INCLUDE_PATH_FULL.'javascript/config_email.js"></script>';
					
					
				});
				\Router::rota('settings/config_email/test_email_host', function(){
					\Models\Config_emailModel::test_email_host();
				});
				\Router::rota('settings/config_email/enviar_teste_email', function(){
					\Models\Config_emailModel::enviar_teste_email();
				});
				

	}
}
?>