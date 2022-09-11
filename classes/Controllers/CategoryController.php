<?php 
namespace Controllers;
class CategoryController extends Controller
{
	
	public function executar()
	{
		\Router::rota('category/'or'category', function(){
			$res = \Models\CategoryModel::verifyPage();
			
			if($res != false){
				$products = \Models\CategoryModel::getProductsOfCategory($res['id']);
				$this->view = new \Views\MainView('category/category');
				$this->view->render(array($res,$products));
				echo '
				<script src="'.INCLUDE_CSS_T01.'category.js"></script>
				<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'category.css">';
			}else{
				header('Location: '.INCLUDE_PATH);
			}
				
			
			
		});
	
	}
}
?>