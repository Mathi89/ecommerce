<?php

namespace Controllers;

class HomeController extends Controller
{

	public function executar()
	{

		\Router::rota('', function () {

			$empresa = \Painel::select('tb_admin.business','id = ?',array('1'));
			$imgp = ($empresa['logo'] == '')? $empresa['logo'] : 'logo.png';
			$this->seo = new \Seo('Product');
			
			$tags = $this->seo->render(
				'Recargas - '.NOME_EMPRESA,
				'Envio de códigos imediato 24h por dia. Compre em até 12 vezes no cartão de crédito. Pix, Boleto e Transferências. Adquiria o seu código e receba imediatamente através do nosso sistema de entrega imediata. Recarga',
				INCLUDE_PATH,
				INCLUDE_PATH.'classes/Views/imgsistem/'.$imgp
			);

				$infos = \Models\HomeModel::pagesDestaques();
				//$imgproduct = \FeaturesCart::getImgProduct();
				$this->view = new \Views\MainView('home');
				$this->view->render(array($infos,'tags'=>$tags));
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
