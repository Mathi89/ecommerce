<?php

namespace Controllers;

class CartController extends Controller
{

	public function executar()
	{

		\Router::rota('cart'or 'cart/', function () {


				$this->view = new \Views\MainView('cart','headerCartPage','footerCartPage');
				$this->view->render(array());
				echo '
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'cart.css">
				<script src="'.INCLUDE_PATH_FULL.'javascript/cart.js"></script>
				';	
			
		});
		
	
		// \Router::rota('home', function () {
		// 	$this->view = new \Views\MainView('home');
		// 	$this->view->render(array('titulo' => 'Home'));
			
		// });

		// \Router::rota('home/trocar_primeira_senha', function () {
		// 	\Models\HomeModel::trocar_primeira_senha();
		// });
		// \Router::rota('home/boas_vindas', function () {
		// 	\Models\HomeModel::boas_vindas();
		// });

		
	}
}
