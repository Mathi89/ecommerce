<?php
include('classes/config.php'); 
require 'vendor/autoload.php';


$autoload = function ($class) {
	$class = str_replace('\\','/',$class);
	
	if ($class == 'Email') {

		include('classes/phpmailer/PHPMailerAutoload.php');
	}
	$packages = explode('/',$class);
	

	if ($packages[0] != 'MercadoPago' && $packages[0] != 'CoffeeCode') {

		include('classes/'.$class.'.php');
	}
};

spl_autoload_register($autoload);
$app = new Application();
$app->executar();

?>