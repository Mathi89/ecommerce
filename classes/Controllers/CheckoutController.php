<?php

namespace Controllers;

class CheckoutController extends Controller
{

	public function executar()
	{

		\Router::rota('checkout'or 'checkout/', function () {

				$totalCompraRS = \Painel::convertMoney(\FeaturesCart::getTotalAmount());
				$totalCompra = \FeaturesCart::getTotalAmount();
				$this->view = new \Views\MainView('checkout','headerCheckoutPage','footerCheckoutPage');
				$this->view->render(array($totalCompraRS,$totalCompra));
				echo '
				<script src="https://sdk.mercadopago.com/js/v2"></script>
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'checkout.css">
				<script src="'.INCLUDE_PATH_FULL.'javascript/checkout.js"></script>
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
