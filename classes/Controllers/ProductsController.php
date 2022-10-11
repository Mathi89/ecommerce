<?php 
namespace Controllers;
class ProductsController extends Controller
{
	
	public function executar()
	{
		\Router::rota('products/'or'products', function(){
			
			$res=\Models\ProductsModel::verifyPage();

			$img = \FeaturesCart::getImgProduct($res['id'],'single'); 
			$imggenerate = INCLUDE_PATH_VIEWS.'imgsproducts/'.($img['img_produto'] == '')? $img['img_produto'] : 'logo.png' ; 
            $imgp = ($img['img_produto'] == '')? $img['img_produto'] : 'logo.png';
			$this->seo = new \Seo('Product');
			
			$tags = $this->seo->render(
				$res['title'].' - '.NOME_EMPRESA,
				$res['description'],
				INCLUDE_PATH.$_GET['url'],
				INCLUDE_PATH.'classes/Views/imgsproducts/'.$imgp
			);

			// ECHO 	$imggenerate;
			\FeaturesCart::addItemToCart();
			// session_destroy();
			
			$vari=\Models\ProductsModel::getVariableRecarga($res['id']);
			$combo=\Models\ProductsModel::getItensCombo($res['id']);
			

			if($res != false){
				$this->view = new \Views\MainView('products/products','headerProductPage','footerProductPage');
				$this->view->render(array($res,$vari,$combo,'tags'=>$tags));
				echo '
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'slickProducts.css">
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'products.css">
				<script src="'.INCLUDE_PATH_FULL.'javascript/slick.js"></script>
				<script src="'.INCLUDE_PATH_FULL.'javascript/products.js"></script>';
				
			}
				
		});
		
	
	}
}
?>