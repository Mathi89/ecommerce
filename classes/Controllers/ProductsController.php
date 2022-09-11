<?php 
namespace Controllers;
class ProductsController extends Controller
{
	
	public function executar()
	{
		\Router::rota('products/'or'products', function(){
			\FeaturesCart::addItemToCart();
			// session_destroy();
			$res=\Models\ProductsModel::verifyPage();
			

			if($res != false){
				$this->view = new \Views\MainView('products/products','headerProductPage','footerProductPage');
				$this->view->render(array($res));
				echo '
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'slick.css">
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'products.css">
				<script src="'.INCLUDE_PATH_FULL.'javascript/slick.js"></script>
				<script src="'.INCLUDE_PATH_FULL.'javascript/products.js"></script>';
				
			}
				
		});
		
	
	}
}
?>