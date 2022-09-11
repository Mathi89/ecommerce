<?php
include('classes/config.php'); 
require 'vendor/autoload.php';


$autoload = function ($class) {
	$class = str_replace('\\','/',$class);
	
	if ($class == 'Email') {

		include('classes/phpmailer/PHPMailerAutoload.php');
	}
	$classMP = explode('/',$class);
	

	if ($classMP[0] != 'MercadoPago') {

		include('classes/'.$class.'.php');
	}
};

spl_autoload_register($autoload);
$app = new Application();
$app->executar();

?>