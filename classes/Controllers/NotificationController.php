<?php 
namespace Controllers;
class NotificationController extends Controller
{
	
	public function executar()
	{


		\Router::rota('notification'or 'notification/', function () {

			
			$this->view = new \Views\MainView('notification');
			$this->view->render(array());
			echo '
			<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'notification.css">
			<script src="'.INCLUDE_PATH_FULL.'javascript/notification.js"></script>';	
		
	});


	}
}
?>