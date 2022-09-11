<?php

namespace Controllers;

class HomeController extends Controller
{

	public function executar()
	{

		\Router::rota('', function () {

			/*DASHBOARD IMOBILIARIA*/

				$infos = \Models\HomeModel::pagesDestaques();
				//$imgproduct = \FeaturesCart::getImgProduct();
				$this->view = new \Views\MainView('home');
				$this->view->render(array($infos));
				echo '
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'slick.css">
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'home.css">
				<script src="'.INCLUDE_PATH_FULL.'javascript/slick.js"></script>
				<script src="'.INCLUDE_PATH_FULL.'javascript/home.js"></script>';	
			
		});
		\Router::rota('home', function () {
			$this->view = new \Views\MainView('home');
			$this->view->render(array('titulo' => 'Home'));
			
		});

		\Router::rota('home/trocar_primeira_senha', function () {
			\Models\HomeModel::trocar_primeira_senha();
		});
		\Router::rota('home/boas_vindas', function () {
			\Models\HomeModel::boas_vindas();
		});

		
	}
}
