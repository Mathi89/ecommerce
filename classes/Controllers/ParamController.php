<?php 
namespace Controllers;
class ParamController extends Controller
{
	
	public function executar()
	{


	// 	\Router::rota('param'or 'param/', function () {

		
	// 		$this->view = new \Views\MainView('param');
	// 		$this->view->render(array());
	// 		echo '
	// 		<link rel="stylesheet" href="'.INCLUDE_CSS_T01.'param.css">
	// 		<script src="'.INCLUDE_PATH_FULL.'javascript/param.js"></script>';	
		
	// });

		\Router::rota('param/addItemToCart', function()
		{
		
			if(isset($_POST['itemid']) && isset($_POST['itemqtd'])){
				
				$itemid = $_POST['itemid'];
				$itemqtd = $_POST['itemqtd'];
				$post = true;
				$res = \FeaturesCart::addItemToCart($post, $itemid, $itemqtd);
			}else{
				$res = false;
			}
			echo json_encode($res);
			
		});


		\Router::rota('param/editItenCart', function()
		{
		
			if(isset($_POST['itemid']) && isset($_POST['itemqtd']) && isset($_POST['type'])){
				
				$itemid = $_POST['itemid'];
				$itemqtd = $_POST['itemqtd'];
				$type = $_POST['type'];
				$post = true;
				$res = \FeaturesCart::editItenCart($post, $itemid, $itemqtd,$type);
			}else{
				$res = false;
			}
			echo json_encode($res);
			
		});

		\Router::rota('param/deleteimgproduct', function()
		{
			if(isset($_POST['idproduct'])){
				$idproduct = $_POST['idproduct'];

				

				if(isset($_POST['idimg'])){
					$idimg = $_POST['idimg'];

				}else{
					$idimg = false;
				}

				if(isset($_POST['img'])){
					$img = $_POST['img'];

				}else{
					$img = false;
				}


				$res = \ConectPainel::deleteimgproduct($idproduct,$img,$idimg);

			}else{
				$res = false;
			}
			
			echo json_encode($res);

		});

		\Router::rota('param/removeItemCart', function()
		{
			if(isset($_POST['itemid'])){

				$itemid = $_POST['itemid'];
				$res = \FeaturesCart::removeItemCart($itemid);

			}else{
				$res = false;
			}
			echo json_encode($res);

		});

		\Router::rota('param/payment', function()
		{
			// if(isset($_POST['itemid'])){

				// $itemid = $_POST['itemid'];
					$totalCompra = $_POST['transactionAmount'];
					$token = $_POST['token'];
					$description = "teste aqui";
					$parcelas = (int)$_POST['installments'];
					$payment_method_id = $_POST['paymentMethodId'];
					$issuer_id = (int)$_POST['issuer'];
					$email = $_POST['email'];
					$tipoDocumento = $_POST['docType'];
					$numeroDocumento = $_POST['docNumber'];
					$cellphone = $_POST['cellphone'];
						$res = \Pay::paymentCreditCard($totalCompra,
												$token,
												$description,
												$parcelas,
												$payment_method_id,
												$issuer_id,
												$email,
												$tipoDocumento,
												$numeroDocumento,
												$cellphone
											);

			// }else{
				// $res = false;
			// }
			echo ($res);

		});

		\Router::rota('param/getFormcard', function()
		{
			// $res = \Pay::getFormcard();
			// echo $res;
			// if($_POST['pix']){
				// \Painel::redirect(INCLUDE_PATH);
			// }

		});

		\Router::rota('param/paymentPix', function()
		{
			// if(isset($_POST[''])){

			// }
			$valorCompra = \FeaturesCart::getTotalAmount();

			$titulo = 'teste';
			$celular = $_POST['tel'];
			$email = $_POST['email'];
			$fname = $_POST['payerFirstName'];
			// $lname = $_POST['payerLastName'];
			// $cpf = $_POST['identificationNumber'];
			$res = \Pay::paymentPix($valorCompra, $titulo,$celular, $fname, $email/* , $lname, $cpf */);
			// $res = \Pay::paymentPix();
		});

		\Router::rota('param/newproduct', function ()
		{
			$res =\FeaturesCart::newproduct();
			echo json_encode($res);
		});

		\Router::rota('param/editproduct', function ()
		{
			$res =\FeaturesCart::editproduct();
			echo json_encode($res);
		});

		\Router::rota('param/getItemCartForMsg', function ()
		{
			if(isset($_POST['reference_id']) && isset($_POST['status'])){

				$reference_id = $_POST['reference_id'];
				$status = $_POST['status'];
				$phone = $_POST['phone'];
				\Pay::getItemCartForMsg($reference_id,$status,$phone);

			}
			
		});
	
	}
}
?>