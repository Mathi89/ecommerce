<?php
    // require_once("display-errors.php");
//     require_once '../vendor/autoload.php';
    


// echo ACESS_TOKEN;

//     MercadoPago\SDK::setAccessToken(ACESS_TOKEN);
    

//     $payment = new MercadoPago\Payment();
//     $payment->transaction_amount = (float)$_POST['transactionAmount'];  //VALOR DA COMPRA
//     $payment->token = $_POST['token'];
//     $payment->description = "teste aqui";
//     $payment->installments = (int)$_POST['installments'];
//     // $payment->payment_method_id = $_POST['paymentMethodId'];
//     $payment->issuer_id = (int)$_POST['issuer'];

//     $payer = new MercadoPago\Payer();
//     $payer->email = $_POST['email'];
//     $payer->identification = array(
//         "type" => $_POST['docType'],
//         "number" => $_POST['docNumber']
//     );
//     $payment->payer = $payer;

//     $payment->save();

//     $response = array(
//         'status' => $payment->status,
//         'status_detail' => $payment->status_detail,
//         'id' => $payment->id
//     );
//     echo json_encode($response);

?>