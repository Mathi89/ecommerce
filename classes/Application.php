<?php

class Application 
{
	
	public function executar()
	{

		// VALIDANDO URL DE HOME
		// if(@explode('/',$_GET['url'])[0] != 'collection' ||  $_GET['url'] == 'reference_email' || $_GET['url'] == 'pass' || $_GET['url'] == 'recuperar' || $_GET['url'] == 'email'){
		if(!isset($_GET['url']))
		{
			$url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home';
			$url = ucfirst($url);
			$url.="Controller";
			if(file_exists('classes/Controllers/'.$url.'.php')){
				$className = 'Controllers\\'.$url;
				$controller = new $className;
				
				$controller->executar();
				
			}else {
				include(BASE_DIR_PAINEL.'erro404.php');

				}; 
			

				// VALIDANDO URL DE CATEGORIAS E PRODUTOS
		}
		
		else if(isset($_GET['url']) AND explode('/',$_GET['url'])[0] != 'collection' AND explode('/',$_GET['url'])[0] != 'cart' AND explode('/',$_GET['url'])[0] != 'param' AND explode('/',$_GET['url'])[0] != 'checkout')
		{

			$url = explode('/',$_GET['url']);
			if(!isset($url[1]) or $url[1] == ""){
			$url = explode('/',$_GET['url'])[0];
			$qtd = 1;
			  }else{
		  
				if(isset($url[1]) and $url[1] != ""){
				  $qtd = 0;
				  foreach ($url as $key => $value) {
					$qtd++;
				  }

				}else{
				  $qtd = 1;
				}
				
			  }

			if($qtd == 1){
			//false = corresponde apenas a categoria na url
			$urlCategory = 'Category';

			}else if($qtd == 2 || $qtd == 3){
			// true = correspoonde a um produto na url
			$urlCategory = 'Products';

			}else{
			// 2 = Voltar para o inicio pois nao condiz com url coreta
			include(BASE_DIR_PAINEL.'erro404.php');
			die();
			}

			$url = $urlCategory;
			$url = ucfirst($url);
			$url.="Controller";
			if(file_exists('classes/Controllers/'.$url.'.php')){
			$className = "Controllers\\".$url;
			$controller = new $className;
			$controller->executar();
			
		

				}else {
					
					include(BASE_DIR_PAINEL.'erro404.php');
					die();
					
				}; 



			// VALIDANDO /COLLETION
		
		}

		// else if(explode('/',$_GET['url'])[0] != 'collection' AND explode('/',$_GET['url'])[0] != 'cart' AND explode('/',$_GET['url'])[0] == 'param')
		// {

		// 	if(!isset(explode('/',$_GET['url'])[1]) || explode('/',$_GET['url'])[1] == '' ){$geturl1 = 'Collectiondestaques' ;}else{ $geturl1 = 'Collectiondestaques'/* explode('/',$_GET['url'])[1] */;}
		// 	$url = $geturl1;
		// 	$url = ucfirst($url);
		// 	$url.="Controller";
		// 	if(file_exists('classes/Controllers/'.$url.'.php')){
		// 	$className = "Controllers\\".$url;
		// 	$controller = new $className;
			
		// 	$controller->executar();
			
		

		// 		}else {
					
		// 			include(BASE_DIR_PAINEL.'erro404.php');
		// 			die();
					
		// 		}; 

		// }
		
		else if(explode('/',$_GET['url'])[0] == 'collection' AND explode('/',$_GET['url'])[0] != 'cart'AND explode('/',$_GET['url'])[0] != 'param' AND explode('/',$_GET['url'])[0] != 'checkout')
		{	
			if(!isset(explode('/',$_GET['url'])[1]) || explode('/',$_GET['url'])[1] == '' ){$geturl1 = 'Collectiondestaques' ;}else{ $geturl1 = 'Collectiondestaques'/* explode('/',$_GET['url'])[1] */;}
			$url = $geturl1;
			$url = ucfirst($url);
			$url.="Controller";
			if(file_exists('classes/Controllers/'.$url.'.php')){
			$className = "Controllers\\".$url;
			$controller = new $className;
			
			$controller->executar();
			
		

				}else {
					
					include(BASE_DIR_PAINEL.'erro404.php');
					die();
					
				}; 


			}else if(explode('/',$_GET['url'])[0] == 'cart'){	

				if(!isset(explode('/',$_GET['url'])[1]) || explode('/',$_GET['url'])[1] == '' ){$geturl1 = 'cart' ;}else{ $geturl1 = 'error'/* explode('/',$_GET['url'])[1] */;}
				$url = $geturl1;
				$url = ucfirst($url);
				$url.="Controller";
				if(file_exists('classes/Controllers/'.$url.'.php')){
				$className = "Controllers\\".$url;
				$controller = new $className;
				
				$controller->executar();
			
		

				}else {
					
					include(BASE_DIR_PAINEL.'erro404.php');
					die();
					
				}; 

			}

			else if(explode('/',$_GET['url'])[0] == 'param'){	

				if(!isset(explode('/',$_GET['url'])[1]) || explode('/',$_GET['url'])[1] == '' ){$geturl1 = 'param' ;}else{ $geturl1 = 'param'/* explode('/',$_GET['url'])[1] */;}
				$url = $geturl1;
				$url = ucfirst($url);
				$url.="Controller";
				if(file_exists('classes/Controllers/'.$url.'.php')){
				$className = "Controllers\\".$url;
				$controller = new $className;
				
				$controller->executar();
			
		

				}else {
					
					include(BASE_DIR_PAINEL.'erro404.php');
					die();
					
				}; 

			}

			else if(explode('/',$_GET['url'])[0] == 'checkout'){	

				if(!isset(explode('/',$_GET['url'])[1]) || explode('/',$_GET['url'])[1] == '' ){$geturl1 = 'checkout' ;}else{ $geturl1 = 'checkout'/* explode('/',$_GET['url'])[1] */;}
				$url = $geturl1;
				$url = ucfirst($url);
				$url.="Controller";
				if(file_exists('classes/Controllers/'.$url.'.php')){
				$className = "Controllers\\".$url;
				$controller = new $className;
				
				$controller->executar();
			
		

				}else {
					
					include(BASE_DIR_PAINEL.'erro404.php');
					die();
					
				}; 

			}

			
			
			else {
				// echo '<script>document.location="'.INCLUDE_PATH.'"</script>';
				// Header('Location:'.INCLUDE_PATH,false);
				die();
		};
		
		


		
	}
}
?>