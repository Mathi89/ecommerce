<?php

namespace Controllers;

class Reference_emailController extends Controller
{

	public function executar()
	{

		\Router::rota('reference_email', function () {


				$this->view = new \Views\MainView('reference_email','','');
				$this->view->render(array());
				echo '<script src="'.INCLUDE_PATH_FULL.'javascript/reference_email.js"></script>';
			
		});
		

		// \Router::rota('reference_email/graficoAdmDois', function () {
		// 	\Models\Reference_emailModel::reference_email();
		// });
		
	}
}
