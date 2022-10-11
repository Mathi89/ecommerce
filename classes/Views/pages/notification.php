<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
}
    MercadoPago\SDK::setAccessToken(ACESS_TOKEN);

	if(isset($_GET['id'])){
	$payment = MercadoPago\Payment::find_by_id($_GET["id"]);

		
	
		if($payment->{'status'} == 'in_process'){
			$returnCompra = $payment->{'status'};
		}else if($payment->{'status'} == 'approved'){
			$returnCompra = $payment->{'status'};
		}else if($payment->{'status'} == 'rejected'){
			$returnCompra = $payment->{'status'};
		}else{
			$returnCompra = $payment->{'status'};
		}

		$reference_id = $payment->{'external_reference'};

		// if(isset($id_compra)){

			$up = MySql::conectar()->prepare("UPDATE `tb_admin.pedidos` SET status = ? WHERE reference_id = ?");
			$up->execute(array($returnCompra,$reference_id));

			$sel = \Painel::select('tb_admin.pedidos','reference_id = ?',array($reference_id));
	
			$msg = \Pay::getItemCartForMsg($reference_id,$returnCompra,$sel['phone'],true);

           if($msg[0] == true){
                
                $url = URL_BOT."send-message";
    			$ch = curl_init();
    			curl_setopt($ch, CURLOPT_URL, $url);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    			curl_setopt($ch, CURLOPT_POST, true);
    
    			$data = array(
    				'number' => $msg[1],
    				'message' => $msg[2]
    			);
    
    			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    			$output = curl_exec($ch);
    			$info = curl_getinfo($ch);
    			curl_close($ch);
			}
            


   }
   

 

?>
